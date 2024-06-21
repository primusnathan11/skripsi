<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}
    public function getAccount(){
        return view('admin.company.account.index', [
            'company' => Partner::get('*'),
        ]);
    }

    public function getProject(){
        return view('admin.company.project.index');
    }
    public function add(){
        return view ('admin.company.account.add');
    }
    public function edit($id){
        $data = Partner::whereId($id)->first();
        // dd($data);
        return view ('admin.company.account.edit',[
            'company' => $data,
        ]);
}
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'address' => 'required',
            'photo' =>'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_active' => 'required|boolean:0,1,true,false',
            'is_verified' => 'required|boolean:0,1,true,false',
        ]);

        if($request->file('photo')){
            $validatedData['photo'] = $request->file('photo')->store('images', 'public');
        }

        $photo = $request->file('photo')->store('images', 'public');
        $verify = $request->input('is_verified');

        Partner::create([
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'phone' => $request->input('phone'),
            'address' =>$request->input('address'),
            'latitude' =>$request->input('latitude'),
            'longitude' =>$request->input('longitude'),
            'photo' =>$photo,
            'is_active' => $request->input('is_active'),
            'is_verified' => $verify,
        ]);
        return redirect()->route('company')
        ->with('success', 'News succesfully added');
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'address' => 'required',
            'photo' =>'nullable',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_active' => 'nullable|boolean:0,1,true,false',
            'is_verified' => 'nullable|boolean:0,1,true,false',
        ]);

        $test = Partner::where('id', $id)
        ->update($validatedData);


        return redirect()->route('company')
        ->with('success', 'Data Berhasil diupdate');

    }
    public function destroy($id)
    {

        $data = Partner::where('id', $id)->first();
        // dd($product);
        if ($data == null) {
            return redirect()->route('company');
        }

        $data->delete();

        return redirect()->route('company');
    }

}
