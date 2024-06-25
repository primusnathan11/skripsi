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
    // $test_data = "halo";

    // return response()->json($test_data);
    $prompt = $request->get('prompt');
    $url = env('GEMINI_URL');
    $accessToken = env('GEMINI_KEY');
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

    // $result = "";
    //     foreach ($responseData as $item) {
    //         if (isset($item['candidates'][0]['content']['parts'])) {
    //             foreach ($item['candidates'][0]['content']['parts'] as $part) {
    //                 $result .= $part['text'];
    //             }
    //         }
    //     }

    //     $cleaned_data = str_replace('*', '', $result);
    //     $data['result'] = $cleaned_data;

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

            // $content = json_decode($request->getContent(), true);
            // $data = $content['prompt'];
            // $content = $request->input('content');




        NewsArticle::create([
            'title' =>$request->input('title'),
            'slug' =>$request->input('slug'),
            'content' =>$request->input('content'),
            // 'content' =>$content,
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
