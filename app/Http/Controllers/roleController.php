<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class roleController extends Controller
{
    function create(Request $request){
        if(role::where("name", $request->name)->exists()){
            return response()->json([
                "status"=> "error",
                "message"=> "role already exists"
            ],404);
        }
        $role = new role;
        $role->name = $request->name;
        $role->save();
        return response()->json([
            "status" => "success",
            "message"=> $request->all()
        ],201);
    }
    function update(Request $request, $id){
        try{
            $role = Role::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No role found with the id ".$id
            ],201);
        }
        if(role::where("name", $request->name)->exists()){
            return response()->json([
                "status"=> "error",
                "message"=> "role already exists"
            ],404);
        }
        $role->name = $request->name;
        $role->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ],201);
    }
    function read($id = null){
        if(empty($id)){
            $role = role::all();
            return response()->json([
                "status"=> "success",
                "message"=> $role->all()
            ],201);
        }
        
        try{
            $role = Role::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No role found with the id ".$id
            ],404);
        }
        return response()->json([
            "status"=> "success",
            "message"=> $role
        ],201);
    }
    function delete($id){
        try{
            $role = role::findorFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No role with id ".$id
            ],404);
        }
        $role->delete();
        return response()->json([
            "status"=> "success"
        ],201);
    }
}