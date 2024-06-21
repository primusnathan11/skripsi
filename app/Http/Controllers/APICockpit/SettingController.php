<?php

namespace App\Http\Controllers\APICockpit;

use App\Constants\ResponseMessage;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    private array $content;

    // public function __construct()
    // {
    //     $this->content = (array) json_decode(file_get_contents(resource_path('header-sidebar.json')));
    // }

    public function index()
    {
        $response = [
            'message' => ResponseMessage::SUCCESS_RETRIEVE,
            'data' => $this->content
        ];

        return response()->json($response, 200);
    }
}
