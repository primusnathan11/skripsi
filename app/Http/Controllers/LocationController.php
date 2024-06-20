<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}
    public function index(){
        return view ('admin.location.index', [
            'locations' => Location::get('*')->where('status','=','Enabled'),
        ]);
    }
    public function indexDisabled(){
        return view ('admin.location.index', [
            'locations' => Location::get('*')->where('status','=','Disabled'),
        ]);
    }

    public function add(){
        return view ('admin.location.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required'
        ]);


        Location::create([
            'name' =>$request->input('name'),
            'description' =>$request->input('description'),
            'latitude' =>$request->input('latitude'),
            'longitude' =>$request->input('longitude'),
            'status' =>$request->input('status')
        ]);
        return redirect()->route('location')
        ->with('success', 'UKM succesfully added');
    }

    public function destroy($id)
    {

        $data = Location::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('location');
        }

        $data->delete();

        return redirect()->route('location');
    }

    public function edit($id){
        $data = Location::whereId($id)->first();
        // dd($data);
        return view ('admin.location.edit',[
            'location' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description'=> 'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'status'=>'required'
        ]);

        Location::where('id', $id)->update($validatedData);


        return redirect()->route('location')
        ->with('success', 'Data Berhasil diupdate');

    }
    public function update_enable($id)
    {
        $data = Location::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('location');
        }

        $data->update(['status'=> 'Enabled']);

        return redirect()->route('indexDisabled');

    }
    public function update_disable($id)
    {
        $data = Location::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('location');
        }

        $data->update(['status'=> 'Disabled']);

        return redirect()->route('location');

    }
}
