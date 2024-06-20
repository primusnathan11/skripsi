<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Models\Donation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        $data['news'] = NewsArticle::orderBy('created_at','desc')->take(5)->where('is_publish', 1)->get();
        $data['donations'] = Donation::orderBy('created_at','desc')->take(3)->where('is_published', '=','Yes')->get();;
        return view ('landing.home.index',$data);
    }

    public function detailNews($id){
        $news = NewsArticle::find($id);
        return view('landing.artikel.artikel', compact('news'));
    }

    public function getBlog(){
        $data['news'] = NewsArticle::orderBy('created_at','desc')->where('is_publish',1)->get();

        return view('landing.blog.index', $data);
    }

}
