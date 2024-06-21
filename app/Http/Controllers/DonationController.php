<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\UKM;
use App\Models\Location;
use App\Models\PlantingPartner;
use App\Models\TreeType;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}
    public function getManage(){
        return view('admin.donation.manage.index',[
            'donations' => DB::table('donations')
                                    ->select('*')
                                    ->where('status','=','Enabled')
                                    ->orderBy('is_published','asc')
                                    ->get()
        ]);
    }
    public function add(){
        return view ('admin.donation.manage.add',[
            'ukms' => UKM::get('*'),
            'locations'=> Location::get('*')->where('status','=','Enabled'),
            'partners'=> PlantingPartner::get('*')->where('status','=','Enabled'),
            'treetype'=> TreeType::get('*')->where('is_adopted','=','1')
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'id_ukm' => 'required',
            'title' => 'required',
            'image' => 'required | max:1024',
            'description' => 'required',
            'target' => 'required',
            'due_date' => 'required',
            'id_location' => 'required',
            'id_mitra' => 'required',
            'id_tree' => 'required',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('donation-images','public');
        }
        $image = $request->file('image')->store('donation-images','public');

        $nama_ukm = DB::table('ukm')
                        ->where('id',$request->input('id_ukm'))
                        ->pluck('name')
                        ->first();

        $nama_location = DB::table('locations')
                            ->where('id',$request->input('id_location'))
                            ->pluck('name')
                            ->first();

        $nama_partner = DB::table('planting_partners')
                        ->where('id', $request->input('id_mitra'))
                        ->pluck('name')
                        ->first();

                        $tree_name = DB::table('tree_types')
                        ->where('id', $request->input('id_tree'))
                        ->pluck('name')
                        ->first();




      $donasi =  Donation::create([
            'title' => $request->input('title'),
            'image' => $image,
            'description' =>$request->input('description'),
            'target' => $request->input('target'),
            'due_date' => $request->input('due_date'),
            'planting_date' => $request->input('planting_date'),
            'id_ukm' => $request->input('id_ukm'),
            'nama_ukm' => $nama_ukm,
            'id_location' => $request->input('id_location'),
            'nama_lokasi' => $nama_location,
            'id_mitra' => $request->input('id_mitra'),
            'nama_mitra' => $nama_partner,
            'id_tree' => $request->input('id_tree'),
            'tree_name' => $tree_name,
            'status' =>$request->input('status'),
            'is_published' =>$request->input('is_published'),
            'is_bingkaikarya' =>$request->input('is_bingkaikarya'),]);

        $qr_name = 'bumibaik.com/donate/'.$donasi->id;
        $qr_code = QrCode::format('png')->size(500)->generate($qr_name);
        $output_file = '/img/qr-code/donation/'.$donasi->title.'.png';
        Storage::disk('public')->put($output_file, $qr_code);
        
        Donation::where('id', $donasi->id)
        ->update([
            'id' => $donasi->id,
            'qr_code' => $output_file
            ]);

        return redirect('donation/manage')->with('success', 'Donation successfully added');
    }

    public function edit($id){
        $data = Donation::whereId($id)->first();
        return view ('admin.donation.manage.edit',[
            'donation' => $data,
            'ukms' => UKM::get('*'),
            'locations'=> Location::get('*')->where('status','=','Enabled'),
            'partners'=> PlantingPartner::get('*')->where('status','=','Enabled'),
            'treetype'=> TreeType::get('*')->where('is_adopted','=','1')


        ]);
}
    public function update(Request $request, $id)
{

        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required | max:1024',
            'description' => 'required',
            'target' => 'required',
            'due_date' => 'required',
            'planting_date' => 'required',
            'id_ukm' => 'required',
            'id_location' => 'required',
            'id_mitra' => 'required',
            'id_tree' => 'required'
        ]);
    $image = $request->file('image')->store('donation-images','public');

    $nama_ukm = DB::table('ukm')
        ->where('id',$request->input('id_ukm'))
        ->pluck('name')
        ->first();

    $nama_location = DB::table('locations')
        ->where('id',$request->input('id_location'))
        ->pluck('name')
        ->first();

    $nama_partner = DB::table('planting_partners')
        ->where('id', $request->input('id_mitra'))
        ->pluck('name')
        ->first();

    $tree_name = DB::table('tree_types')
        ->where('id', $request->input('id_tree'))
        ->pluck('name')
        ->first();

    $test = Donation::where('id', $id)
    ->update([
        'title' => $request->input('title'),
        'image' => $image,
        'description' =>$request->input('description'),
        'target' => $request->input('target'),
        'due_date' => $request->input('due_date'),
        'planting_date' => $request->input('planting_date'),
        'id_ukm' => $request->input('id_ukm'),
        'nama_ukm' => $nama_ukm,
        'id_location' => $request->input('id_location'),
        'nama_lokasi' => $nama_location,
        'id_mitra' => $request->input('id_mitra'),
        'nama_mitra' => $nama_partner,
        'id_tree' => $request->input('id_tree'),
        'tree_name' => $tree_name,
        'status' =>$request->input('status'),
        'is_published' =>$request->input('is_published'),
        'is_bingkaikarya' =>$request->input('is_bingkaikarya'),
    ]);

        return redirect()->route('get.manage')
        ->with('success', 'Data Berhasil diupdate');

    }

    public function filter(Request $request){


        $status = $request->input('status');
        $is_published = $request->input('is_published');

        return view('admin.donation.manage.filteredIndex',[
            'donations' => DB::table('donations')
                                    ->select('*')
                                    ->when ($status, function ($query, $status) {
                                        return $query->where('status','=', $status);
                                    })
                                    ->when ($is_published, function ($query, $is_published) {
                                        return $query->where('is_published','=', $is_published);
                                    })
                                    ->orderBy('id','asc')
                                    ->get()
        ]);
    }

    public function destroy(Donation $donation, $id){
        $data = Donation::where('id', $id)->first();
        // dd($product);
        if ($data == null) {
            return redirect()->route('get.manage');
        }

        $data->delete();

        return redirect()->route('get.manage');
    }
    public function update_publish($id)
    {
        $data = Donation::where('id', $id)->first();
        if ($data == null) {
            return redirect('donation/manage');
        }

        $data->update(['is_published'=> 'Yes']);

        return redirect('donation/manage');
    }

    public function update_unpublish($id)
    {
        $data = Donation::where('id', $id)->first();
        if ($data == null) {
            return redirect('donation/manage');
        }

        $data->update(['is_published'=> 'No']);

        return redirect('donation/manage');
    }

    public function update_enable($id)
    {
        $data = Donation::where('id', $id)->first();
        if ($data == null) {
            return redirect('donation/manage');
        }

        $data->update(['status'=> 'Enabled']);

        return redirect('donation/manage');
    }

    public function update_disable($id)
    {
        $data = Donation::where('id', $id)->first();
        if ($data == null) {
            return redirect('donation/manage');
        }

        $data->update(['status'=> 'Disabled']);

        return redirect('donation/manage');
    }
    public function qr_download($id){
        $data = Donation::where('id', $id)->first();
        $pathToFile = public_path('donations/qr_code/{id}');
        return Response::download($pathToFile);
    }

}
