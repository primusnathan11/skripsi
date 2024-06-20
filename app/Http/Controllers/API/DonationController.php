<?php

namespace App\Http\Controllers\API;

use App\Constants\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    public function index(){
        $donations = Donation::where('is_published', 'Yes');
        $donations->where('status', 'Enabled');
        $donations->select(
            'id', 'title', 'image',
            'nama_ukm', 'nama_lokasi', 'nama_mitra', 'target', 'collected', 'due_date'
        );

        $list = $donations->get();
        for ($index = 0; $index < count($list); $index++) {
            $target = $list[$index]->target;
            $collected = $list[$index]->collected;
            $target = $list[$index]->target;
            $collected = $list[$index]->collected;

            $list[$index]->new_image = Storage::url($list[$index]->image);
            $list[$index]->progress = $collected != 0 ? (double)number_format(($collected / $target) * 100, 2, '.', ','): 0;
        }

        return response()->json([
            "message" => ResponseMessage::SUCCESS_RETRIEVE,
            "data" => $list
        ]);
    }

    public function get_detail_donation($id){
        $donation = Donation::findorFail($id);
        return $this->_responseDonationDetail($donation);
    }

    private function _responseDonationDetail($donation){
        
        $target = $donation->target;
        $collected = $donation->collected;
        
        $data = [
            'id'    => $donation->id,
            'title' => $donation->title,
            'image' => Storage::url($donation->image),
            'description' => $donation->description,
            'target' => $donation->target,
            'collected' => $donation->collected,
            'due_date' => $donation->due_date,
            'nama_ukm' => $donation->nama_ukm,
            'nama_lokasi' => $donation->nama_lokasi,
            'planting_date' => $donation->planting_date,
            'nama_mitra' => $donation->nama_mitra,
            'target' => $donation->target,
            'collected' => $donation->collected,
            'due_date' => $donation->due_date,
            'progress' => $collected != 0 ? (double)number_format(($collected / $target) * 100, 2, '.', ','): 0,
        ];

        return response()->json([
            "message" => ResponseMessage::SUCCESS_RETRIEVE,
            "data" => $data
        ]);
    }
}
