<?php

namespace App\Http\Controllers\API;

use App\Constants\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\BasicMethodGetRequest;
use App\Services\Project\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $mainService;
    public function __construct(ProjectService $service)
    {
        $this->mainService = $service;
    }

    public function getProjectsUser(BasicMethodGetRequest $request)
    {
        $user_id = auth('api')->user()->id;
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $data = $this->mainService->getProjectsUser($user_id);

        $resp = [
            'message' => ResponseMessage::SUCCESS_RETRIEVE,
            'data' => $data,
        ];
        return response()->json($resp, 200);
    }

    public function getDetailProject($id)
    {
        $data = $this->mainService->getDetailProject($id);
        $resp = [
            'message' => ResponseMessage::SUCCESS_RETRIEVE,
            'data' => $data,
        ];
        return response()->json($resp, 200);
    }
}
