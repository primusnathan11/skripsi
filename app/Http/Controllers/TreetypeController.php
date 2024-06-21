<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TreeType;
use Validator;
use Illuminate\Http\Request;

class TreetypeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}
    public function index(){
        return view('admin.treetype.index', [
            'treetype' => TreeType::get('*'),
        ]);
    }
    public function add(){
        return view ('admin.treetype.add');
    }
    public function edit($id){
        $data = TreeType::whereId($id)->first();
        // dd($data);
        return view ('admin.treetype.edit',[
            'treetype' => $data,
        ]);
    }
public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'is_adopted' => 'required|boolean: 0, 1',
        ]);

        TreeType::create([
            'name' =>$request->input('name'),
            'description' =>$request->input('description'),
            'is_adopted' =>$request->input('is_adopted'),
        ]);
        return redirect('/treetype')
        ->with('success','partner successfully added');
        ;

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'is_adopted' => 'required|boolean: 0, 1',
        ]);
    //    dd($validatedData);

        $test = TreeType::where('id', $id)
        ->update([
            'name' =>$request->input('name'),
            'description' =>$request->input('description'),
            'is_adopted' =>$request->input('is_adopted'),
        ]);


        return redirect('/treetype')
        ->with('success', 'Data Berhasil diupdate');

    }
    public function update_enable($id)
    {
        $data = TreeType::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('treetype');
        }

        $data->update(['is_adopted'=> "1"]);

        return redirect()->route('treetype');

    }
    public function update_disable($id)
    {
        $data = TreeType::where('id', $id)->first();
        if ($data == null) {
            return redirect()->route('treetype');
        }

        $data->update(['is_adopted'=> "0"]);

        return redirect()->route('treetype');

    }

    public function destroy($id)
    {

        $data = TreeType::where('id', $id)->first();
        // dd($product);
        if ($data == null) {
            return redirect()->route('treetype');
        }

        $data->delete();

        return redirect()->route('treetype');
    }
}
