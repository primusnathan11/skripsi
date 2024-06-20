<?php

namespace App\Http\Controllers;

use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCodeTest\Integration\ImagickRenderingTest;
use claviska\SimpleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Imagick;

class QrController extends Controller{
    public function index(){
        for($x = 1; $x <= 10; $x++){
            $treeName = 'BB2023KTG'.sprintf("%04d", $x);
            $image = QrCode::format('png')->size(500)->generate($treeName);
            $output_file = '/img/qr-code/PT Indofood/'.$treeName.'.png';
            Storage::disk('local')->put($output_file, $image);

        }
    }
    public function convert(){
        for($x = 1; $x <= 5; $x++){
            $newImg = new Imagick();
            $newImg->readImage(public_path('SOLINI_1-5000/1-500/BB2023SOL'.$x.'.pdf'));
            $saveImagePath = public_path('SOLINI_1-5000/1-500/BB2023SOL'.$x.'.png');
            $newImg->writeImages($saveImagePath, true);
        }

        dd("Berhasil");
    }
}
