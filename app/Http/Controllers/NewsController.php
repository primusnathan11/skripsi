<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Gemini;
use Validator;


class NewsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}

    public function index(){
        return view ('admin.news.index', [
            'news' => NewsArticle::orderBy('created_at','desc')->get('*'),
        ]);
}
public function generate_news(Request $request){
    $prompt = $request->get('prompt');
    $url = 'https://us-central1-aiplatform.googleapis.com/v1/projects/herbify-403310/locations/us-central1/publishers/google/models/gemini-1.5-pro:streamGenerateContent';
    $accessToken = "ya29.a0AXooCgsJBQ_acdIn3qyPZgHxYwvoXkwZVpNkXWE6NGtK6AAtrxvqHt1doTfcDcfXYKARL_N9TvceYxWy5dmQbF3TPDSYf5kKcgCXuLfBYG_MH4xAzq9_vPgm9gZ4GVsSxsoBvv6pLXhBVZPG1lgNgODVmssBxVWi76GXeHtBCW6tEtrto8vDzeQhPbSNWGonK7pyt2P1WNVWuVtUnc8mzHPSoN_keQoL3EHceL9Fq19W_dUBaoOvq5eYVROAwRr7wHKED_y5grHnhxglaWtOps1_PTLSdpNJ2CKCfNTwMoLJ69B1lxmKtMgFJJp9GPiB4aCtZM7FYiMmHl2JQisih53Qxh9g6c9yXB1FCFrWHJAfW5NmI9lU8EjdTVLnbRHLxoLFTqMCmvOml0plEmOQohOTSckvM7rlUgaCgYKAa4SARMSFQHGX2MiQi762RMrot8YkGhguuYbFQ0425";

    $postData = [
        "contents" => [
            "role" => "user",
            "parts" => [
                "text" => $prompt,
            ]
        ],
        "generation_config" => [
            "temperature" => 0.2,
            "topP" => 0.8,
            "topK" => 40
        ]
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ];
    // print_r($headers);die;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return response()->json(['error' => $error_msg], 500);
    }
    curl_close($ch);

    $responseData = json_decode($response, true);

    return response()->json($responseData);
}

    public function add(){
        return view ('admin.news.add');
}
    public function edit($id){
        $data = NewsArticle::whereId($id)->first();
        return view ('admin.news.edit',[
            'news' => $data,
        ]);
}
public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp|max:1024',
            'author' => 'required',
            'is_publish' => 'nullable|boolean:0,1,true,false'
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors([
                'image' => 'Image is more than 1 mb',
            ])->onlyInput('image');
        } else {
            $image = $request->file('image')->store('images/newsletter', 'public');



        NewsArticle::create([
            'title' =>$request->input('title'),
            'slug' =>$request->input('slug'),
            'content' =>$request->input('body'),
            'image' =>$image,
            'author' =>$request->input('author'),
            'is_publish' => $request->input('type'),
        ]);

        return redirect()->route('news')
        ->with('success','news successfully added');
        }

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images/newsletter', 'public');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'image' => 'nullable',
            'author' => 'required',
            'is_publish' => 'nullable|boolean: 0, 1, true, false'
        ]);

        $test = NewsArticle::where('id', $id)
        ->update($validatedData);


        return redirect()->route('news')
        ->with('success', 'Data Berhasil diupdate');

    }
    public function destroy($id)
    {

        $data = NewsArticle::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('news');
        }

        $data->delete();

        return redirect()->route('news');
    }



}
