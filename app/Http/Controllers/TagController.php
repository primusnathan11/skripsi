<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Image\Manipulations;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;


class TagController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function add(){
        return view ('admin.tag.add');
    }
    public function print(Request $request){

        $file = new Filesystem;
        $file->cleanDirectory(public_path('images/tag'));

        $request->validate([
            'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        $tag_code = $request->input('tag_code');
        $company_name = $request->input('company_name');
        $company_logo = $request->file('company_logo');
        $start = $request->input('start');
        $end = $request->input('end');


        for($x = $start; $x <= $end; $x++){
            $code_format = $tag_code;
            $outputname = $code_format.$x;
            $qr_code = QrCode::format('png')->size(180)->margin(0)->generate($outputname);
            $imagePath = public_path('raw_tag.jpg');
            $company_logo = Image::make($request->file('company_logo'))->resize(100, 100);
            // $logo_path = public_path('images/tag/logo/'.$company_logo);
            // $logo_overlay = Image::make($logo_path);

            $img = Image::make($imagePath)
                ->text($outputname, 1375, 150, function ($font) {
                    $font->file(public_path('fonts/myriadbold.OTF'));
                    $font->size(60);
                    $font->color('#000000');
                    // $font->align('center');
                    $font->valign('middle');
                })
                ->text($company_name, 1050, 80, function ($font) {
                    $font->file(public_path('fonts/myriadregular.OTF'));
                    $font->size(60);
                    $font->color('#000000');
                    // $font->align('center');
                    $font->valign('top-middle');
                })
                ->insert($qr_code,'center-right',330)
                ->insert($company_logo,'bottom-right', 50);

            $img->save(public_path('images/tag/'.$outputname.'.png'));
        }
        $zip = new ZipArchive;
        $zipFileName = $company_name.'.zip';

        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            $filesToZip = File::files(public_path('images/tag'));

            foreach ($filesToZip as $file => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }

            $zip->close();

        return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        }   else {
            return "Failed to create the zip file.";
        }

        $file->cleanDirectory(public_path('images/tag'));

    }
}

