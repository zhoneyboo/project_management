<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barangay;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function generate_word(Request $request)
    {
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=document_name.doc");
            echo "<html>";
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
            echo "<body>";
            echo $request->input('codes');
            echo "</body>";
            echo "</html>";
            return 'success';
    }


    public function get_addresses()
    {
        // $addresses = Barangay::where('ref_brgy.prov_id', 24)
        //                         ->join('ref_region', 'ref_region.id','ref_brgy.reg_id')
        //                         ->join('ref_citymun', 'ref_citymun.id','ref_brgy.citymun_id')
        //                         ->join('ref_province', 'ref_province.id','ref_brgy.prov_id')
        //                         ->select(DB::raw('CONCAT(UCASE(brgyDesc), " ", UCASE(citymunDesc), ", ", UCASE(provDesc)) as address'))
        //                         ->get();
        // return $addresses;
    }
}
