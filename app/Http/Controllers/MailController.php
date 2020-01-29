<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\UserVerification;


class MailController extends Controller
{
    public function test_mail()
    {
    	Mail::to('mark.alfred072915@gmail.com')
    			->send(new UserVerification());
    	echo "mail sent";
    }
}
