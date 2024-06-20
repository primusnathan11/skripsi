<?php

namespace App\Http\Controllers\APICockpit;

use App\Constants\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\TreeTypeCreateRequest;
use App\Http\Requests\TreeTypeGetRequest;
use App\Http\Requests\TreeTypeUpdateRequest;
use App\Models\TreeType;
use Illuminate\Http\Request;

class TreeTypeController extends Controller
{
    public function create_tree_type(TreeTypeCreateRequest $req)
    {
        TreeType::create([
            'partner_id'    => $req->input('partner_id'),
            'name'          => $req->input('name'),
            'description'   => $req->input('description'),
            'sequestration' => $req->input('sequestration')
        ]);

        return response()->json([
            'message' => ResponseMessage::SUCCESS_CREATE
        ], 201);
    }

    public function update_tree_type(TreeTypeUpdateRequest $req)
    {
        $treeType = TreeType::find($req->input('id'));
        $treeType->partner_id       = $req->input('partner_id');
        $treeType->name             = $req->input('name');
        $treeType->description      = $req->input('description');
        $treeType->sequestration    = $req->input('sequestration');
        $treeType->save();

        return response()->json([
            'message' => ResponseMessage::SUCCESS_UPDATE
        ]);
    }

    public function get_tree_type(TreeTypeGetRequest $req)
    {
        $page   = $req->input('page');
        $limit  = $req->input('limit');
        $search = !empty($req->input('search')) ? $req->input('search') : "";

        $treeTypes = TreeType::where('name', 'like', '%' . $search . '%')->paginate($limit, ['*'], 'page', $page);
        $treeTypeDatas = $treeTypes->map(
            function ($treeType) {
                return [
                    'id'            => $treeType->id,
                    'name'          => $treeType->name,
                    'description'   => $treeType->description,
                    'partner'       => [
                        'id'    => $treeType->partner->id,
                        'name'  => $treeType->partner->name,
                    ]
                ];
            }
        );

        if ($treeTypeDatas == null) {
            return response()->json([
                'message' => ResponseMessage::SUCCESS_RETRIEVE,
                'data'    => []
            ], 204);
        } else {
            return response()->json([
                'message'  => ResponseMessage::SUCCESS_RETRIEVE,
                'data'     => $treeTypeDatas,
                'meta'     => [
                    'page'       => $treeTypes->currentPage(),
                    'limit'      => $treeTypes->perPage(),
                    'total'      => $treeTypes->total(),
                    'total_page' => $treeTypes->lastPage(),
                ]
            ], 200);
        }
    }

    public function get_tree_type_by_id($id)
    {
        $treeType = TreeType::find($id);

        if ($treeType == null) {
            return response()->json([
                'message' => ResponseMessage::SUCCESS_RETRIEVE,
                'data'    => []
            ], 204);
        } else {
            unset(
                $treeType->partner->email,
                $treeType->partner->phone,
                $treeType->partner->address,
                $treeType->partner->photo,
                $treeType->partner->latitude,
                $treeType->partner->longitude,
                $treeType->partner->is_active,
                $treeType->partner->is_verified,
            );

            return response()->json([
                'message'  => ResponseMessage::SUCCESS_RETRIEVE,
                'data'     => $treeType
            ], 200);
        }
    }
}
