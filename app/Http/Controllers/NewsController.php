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
    $test_data = "halo";

    return response()->json($test_data);
    $prompt = $request->get('prompt');
    $url = 'https://us-central1-aiplatform.googleapis.com/v1/projects/herbify-403310/locations/us-central1/publishers/google/models/gemini-1.5-pro:streamGenerateContent';
    $accessToken = "ya29.a0AXooCgu0m1UgcfwUHdnaAGqT8cWH86r5bneVl5rLck-fJl90s67-4Gw4HxuEI9PDp2J-TqWSogPz51g8j1IaRHPh55PiWqEB1cRoJSE6RJAIDvdMmV-g8saxpYHn4060UozAbDMVxSUUeXHloE_JVIBEBTyL---fTMziX2UPlwibP26mcveEV1OI-BdJIImI9DOn2jax2CMMsbef2eg6JpFgTmbI93gEzSC-ETZGIhXj8snVbJM1LysXAckdGH6rZLW2NTeFO2vrQNxe1FtwSALp-QE6mYn7DqQZm-2DyIm6rbdjBNkzo1sBezKpWy6B-foANK_TnUZgmJFd49RaNhiH_FcP2vmE8dWr5LPcZJSAlTOwL4Ih1wc8URVk1q8g04BkyrAZeJarI0zv4aN1NgcMHlP5RGRKaCgYKASwSARMSFQHGX2Mi_6cJZhu-4X_tqaiKogBVXQ0423";
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

    $result = "";
        foreach ($responseData as $item) {
            if (isset($item['candidates'][0]['content']['parts'])) {
                foreach ($item['candidates'][0]['content']['parts'] as $part) {
                    $result .= $part['text'];
                }
            }
        }
        // dd($result);
        $cleaned_data = str_replace('*', '', $result);
        $data['result'] = $cleaned_data;

        // "Unable to submit request because it must include one of the following input parameters: text, fileData, inlineData, functionCall or functionResponse. Learn more: https://cloud.google.com/vertex-ai/generative-ai/docs/model-reference/gemini"
    return response()->json($cleaned_data);

        // return view ('admin.news.add', [
        //     'cleaned_data' => $cleaned_data,
        // ]);

        
        
        // return response()->json($cleaned_data);
    // $textResult = '';
    // if (isset($responseData) && is_array($responseData)) {
    //     foreach ($responseData as $item) {
    //         if (isset($item['candidates'])) {
    //             foreach ($item['candidates'] as $candidate) {
    //                 if (isset($candidate['content']['parts'])) {
    //                     foreach ($candidate['content']['parts'] as $part) {
    //                         if (isset($part['text'])) {
    //                             $textResult .= $part['text'];
    //                             return response()->json($textResult);
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }


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
