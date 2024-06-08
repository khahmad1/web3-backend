<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\role;
class roleController extends Controller
{
    function create(Request $request){
        $role = new role;
        $role->name = $request->name;
        $role->save();
        return response()->json([
            "status" => "success",
            "message"=> $request->all()
        ]);
    }
    function update(Request $request, $id){
        $role = role::find($id);
        $role->name = $request->name;
        $role->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function read($id = null){
        if(empty($id)){
            $role = role::all();
            return response()->json([
                "status"=> "success",
                "message"=> $role->all()
            ]);
        }
        $role = role::find($id);
        return response()->json([
            "status"=> "success",
            "message"=> $role
        ]);
    }
    function delete($id){
        $role = role::find($id);
        $role->delete();
        return response()->json([
            "status"=> "success"
        ]);
    }
}