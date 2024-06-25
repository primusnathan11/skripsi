<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}
public function index(){
    return view ('admin.users.index', [
        'users' => User::get('*')
    ]);
}

public function add(){
    return view ('admin.users.add');
}
public function edit($id){
    $data = User::whereId($id)->first();
    return view ('admin.users.edit',[
        'user' => $data,
    ]);
}
public function store(Request $request)
{
    $validatedData = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'telp' => 'required',
        'role' => 'required',
        'password' => 'required'
    ]);

    User::create([
        'name' =>$request->input('name'),
        'email' =>$request->input('email'),
        'telp' =>$request->input('telp'),
        'role' => $request->input('role'),
        'password' => $request->input('password'),
        
    ]);

    return redirect()->route('user')
    ->with('success','news successfully added');
    

    
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'telp' => 'required',
        'role' => 'required',
        'password' => 'required'

    ]);

    $test = User::where('id', $id)
    ->update($validatedData);


    return redirect()->route('user')
    ->with('success', 'Data Berhasil diupdate');

}

public function destroy($id){

    $data = User::where('id', $id)->first();
    if ($data == null) {
        return redirect()->route('user');
    }

    $data->delete();

    return redirect()->route('user');
}

}
