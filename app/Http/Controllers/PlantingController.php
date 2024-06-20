<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PlantingPartner;
use Validator;
use Illuminate\Http\Request;

class PlantingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}
    public function index(){
        return view('admin.plantingpartner.index', [
            'planting' => PlantingPartner::get('*'),
        ]);
    }
    public function add(){
        return view ('admin.plantingpartner.add');
    }
    public function edit($id){
        $data = PlantingPartner::whereId($id)->first();
        // dd($data);
        return view ('admin.plantingpartner.edit',[
            'plantingpartner' => $data,
        ]);
    }
public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required'
        ]);

        PlantingPartner::create([
            'name' =>$request->input('name'),
            'status' => $request->input('status')
        ]);
        return redirect('/plantingpartner')
        ->with('success','partner successfully added');
        ;

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
    //    dd($validatedData);

        $test = PlantingPartner::where('id', $id)
        ->update([
            'name' => $request->input('name'),
            'status' => $request->input('status')
        ]);


        return redirect('/plantingpartner')
        ->with('success', 'Data Berhasil diupdate');

    }
    public function destroy($id)
    {

        $data = PlantingPartner::where('id', $id)->first();
        // dd($product);
        if ($data == null) {
            return redirect()->route('plantingpartner');
        }

        $data->delete();

        return redirect()->route('plantingpartner');
    }
    public function update_enable($id)
    {
        $data = PlantingPartner::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('plantingpartner');
        }

        $data->update(['status'=> 'Enabled']);

        return redirect()->route('plantingpartner');

    }
    public function update_disable($id)
    {
        $data = PlantingPartner::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('plantingpartner');
        }

        $data->update(['status'=> 'Disabled']);

        return redirect()->route('plantingpartner');

    }

}
