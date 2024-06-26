<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        return view('admin.company.project.index', [
            'project' => Project::get('*'),
        ]);
    }

    public function add(){
        return view ('admin.company.account.add');
    }

    public function addProject(){
        return view ('admin.company.project.add',[
            'partners'=> Partner::get('*'),
        ]);
    }

    public function edit($id){
        $data = Partner::whereId($id)->first();
        // dd($data);
        return view ('admin.company.account.edit',[
            'company' => $data,
        ]);
    }

    public function editProject($id){
        $data = Project::whereId($id)->first();
        // dd($data);
        return view ('admin.company.project.edit',[
            'project' => $data,
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

    public function storeProject(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name'=> 'required',
            'description'=> 'required',
            'address'=> 'required',
            'photo'=> 'required',
            'user_id'=> 'required',
            'planting_date'=> 'required',

        ]);
        $nama_company = DB::table('partners')
                        ->where('id',$request->input('user_id'))
                        ->pluck('name')
                        ->first();

        if($request->file('photo')){
            $validatedData['photo'] = $request->file('photo')->store('images', 'public');
        }

        $photo = $request->file('photo')->store('images', 'public');


        Project::create([
            'name' =>$request->input('name'),
            'description' =>$request->input('description'),
            'address' =>$request->input('address'),
            'photo' =>$photo,
            'user_id'=>$request->input('user_id'),
            'nama_company'=>$nama_company,
            'planting_date' =>$request->input('planting_date'),
        ]);
        return redirect()->route('projects')
        ->with('success', 'project succesfully added');
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


        return redirect()->route('company/projects')
        ->with('success', 'Data Berhasil diupdate');

    }
    public function updateProject(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name'=> 'required',
            'description'=> 'required',
            'address'=> 'required',
            'photo'=> 'required',
            'planting_date'=> 'required',

        ]);

        $test = Project::where('id', $id)
        ->update($validatedData);


        return redirect()->route('projects')
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

    public function destroyProject($id)
    {

        $data = Project::where('id', $id)->first();
        // dd($product);
        if ($data == null) {
            return redirect()->route('projects');
        }

        $data->delete();

        return redirect()->route('projects');
    }

}
