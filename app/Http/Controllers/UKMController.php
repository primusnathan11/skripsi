<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UKM;

class UKMController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}
    public function index(){
        return view ('admin.ukm.index', [
            'ukm' => UKM::get('*'),
        ]);
    }
    public function add(){
        return view ('admin.ukm.add');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'pic' => 'required',
        ]);


        UKM::create([
            'name' =>$request->input('name'),
            'status' =>$request->input('status'),
            'pic' =>$request->input('pic'),
        ]);
        return redirect()->route('ukm')
        ->with('success', 'UKM succesfully added');
    }

    public function destroy($id)
    {

        $data = UKM::where('id', $id)->first();
        // dd($product);
        if ($data == null) {
            return redirect()->route('ukm');
        }

        $data->delete();

        return redirect()->route('ukm');
    }
    public function edit($id){
        $data = UKM::whereId($id)->first();
        // dd($data);
        return view ('admin.ukm.edit',[
            'ukm' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'pic' => 'required',
        ]);

        $test = UKM::where('id', $id)
        ->update($validatedData);


        return redirect()->route('ukm')
        ->with('success', 'Data Berhasil diupdate');

    }
    public function update_enable($id)
    {
        $data = UKM::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('ukm');
        }

        $data->update(['status'=> 'Enabled']);

        return redirect()->route('ukm');

    }
    public function update_disable($id)
    {
        $data = UKM::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('ukm');
        }

        $data->update(['status'=> 'Disabled']);

        return redirect()->route('ukm');

    }
}
