<?php

namespace App\Http\Controllers\APICockpit;

use App\Constants\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\TreeCreateRequest;
use App\Http\Requests\TreeUpImageRequest;
use App\Models\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TreeController extends Controller
{
    public function upload_image_tree(TreeUpImageRequest $req)
    {
        $img = $req->file('img')->store('trees');

        $res['img_url']     = Storage::url($img);
        $res['longitude']   = '';
        $res['latitude']    = '';

        return response()->json([
            'message' => ResponseMessage::SUCCESS_CREATE,
            'data'    => $res
        ], 201);
    }
    public function create_tree(TreeCreateRequest $req)
    {
        Tree::create([
            'type_id'       => $req->input('tree_type'),
            'code'          => $req->input('code'),
            'description'   => $req->input('description'),
            'planting_date' => $req->input('planting_date'),
            'image'         => $req->input('image'),
            'longitude'     => $req->input('longitude'),
            'latitude'      => $req->input('latitude'),
            'production'    => $req->input('production')
        ]);

        return response()->json([
            'message'   => ResponseMessage::SUCCESS_CREATE
        ], 201);
    }
}
