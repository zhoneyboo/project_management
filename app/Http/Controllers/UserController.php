<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AccessList;
use App\UserAccess;
use Auth;
use Hash;

class UserController extends Controller
{

	public function getAuth()
	{
		return Auth::user();
		// return User::where('id', Auth::user()->id)->with('access')->first();
	}


	public function create(Request $request, User $user)
	{
		// validate form information
		$validate = $request->validate([
            'password' => 'required|confirmed|min:6|max:255',
            'username' => 'required|unique:users,email|min:3|max:255',
            'name' => 'required|min:3|max:255',
		]);

		// add user to our database
		$create = $user::create([
			'email' => $request->input('username'),
			'password' => bcrypt($request->input('password')),
			'name' => $request->input('name'),
		]);

		return $this->returnMessage($create, 'success', 'error');
	}


	public function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        $password = $user->password;

        $request->validate([
            'password' => 'required|confirmed|min:6|max:255',
            'old_password' => 'required',
        ]);

        $new_password = $request->input('password');
        $old_password = $request->input('old_password');

        if(Hash::check($old_password, $password))
        {
            $user->password = bcrypt($new_password);
            $user->save();

            return [
                    'type' => 'success',
                    'message' => "Password is now updated!",
                ]; 

        }else{
            return [
                    'type' => 'error',
                    'message' => "Old password doesnt match!",
                ]; 
        }
    }

	// retreive all user
	public function getUserList(User $user)
	{
		return User::get();
	}


	// access contoller
	public function create_new_access(Request $request, AccessList $ACCESS_LIST)
	{
		$validate = $request->validate([
			'access_key' => 'required|unique:access_lists',
			'access_name' => 'required',
			'description' => 'required',
		]);

		// try creating new access
		$create = $ACCESS_LIST::create([
			'access_key' => $request->input('access_key'),
			'access_name' => $request->input('access_name'),
			'description' => $request->input('description'),
		]);

		return $this->returnMessage($create, 'success', 'error');
	}

	public function get_all_access(AccessList $ACCESS_LIST)
	{
		return $ACCESS_LIST::get();
	}

	public function delete_access(Request $request, AccessList $ACCESS_LIST)
	{
		$validate = $request->validate([
			'id' => 'required'
		]);

		$delete = $ACCESS_LIST::where('id', $request->input('id'))
							->delete();

		return $this->returnMessage($delete, 'success', 'error');
	}

	public function add_user_access(Request $request, UserAccess $USER_ACCESS)
	{
		$validate = $request->validate([
			'user_id' => 'required',
			'access_id' => 'required',
		]);

		$find = $USER_ACCESS::where([
										'user_id' => $request->input('user_id'),
										'access_id' => $request->input('access_id'),
									])->get();
		if(count($find) <= 0)
		{
			$create = $USER_ACCESS::create([
										'user_id' => $request->input('user_id'),
										'access_id' => $request->input('access_id'),
									]);
			return $this->returnMessage($create, 'success', 'error');
		}else{
			return $this->returnMessageWithThrowError('error_message', 402);
		}
	}


	public function get_user_access(Request $request, UserAccess $USER_ACCESS)
	{
		$validate = $request->validate([
			'id' => 'required'
		]);

		$find = $USER_ACCESS::where('user_id', $request->input('id'))
							->with('access')
							->get();

		return $find;
	}

	public function remove_user_access(Request $request, UserAccess $USER_ACCESS)
	{
		$validate = $request->validate([
			'user_id' => 'required'
		]);

		$delete = $USER_ACCESS::where([
										'user_id' => $request->input('user_id'),
										'access_id' => $request->input('access_id'),
									])->delete();
		return $this->returnMessage($delete, 'success', 'error');
	}


	public function returnMessage($bool, $success_message, $error_message)
	{
		if($bool)
		{
			return $success_message;
		}else{
			return $error_message;
		}
	}

	public function returnMessageWithThrowError($error_message, $errorcode)
	{
		return response($error_message, $errorcode)
                  ->header('Content-Type', 'text/plain');
	}



}
