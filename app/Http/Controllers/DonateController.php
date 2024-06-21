<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class DonateController extends Controller
{
     //
    public function index(){
        return view('landing.donate.donate',[
            'donations' => DB::table('donations')
                                    ->select('*')
                                    ->where('status','=','Enabled')
                                    ->where('is_published','=','Yes')
                                    ->get()
        ]);
    }

    public function detail($id){
        $data['donations']  = Donation::find($id);
        $data['location']   = Location::find($data['donations']->id_location);
        return view('landing.donate.donate-detail', $data);
    }

    public function payment($id){
        $donations  = Donation::find($id);
        if($donations->is_bingkaikarya == 'Yes'){
            return view('landing.donate.donate-payment-bingkai-karya', compact('donations'));
        }
        else{
            return view('landing.donate.donate-payment', compact('donations'));
        }
    }
}
