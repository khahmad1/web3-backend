<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\type;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class typeController extends Controller
{
    function create(Request $request){
        if(type::where("type", $request->type)->exists()){
            return response()->json([
                "status"=>"error",
                "message"=> "type already exists with that name"
            ],404);
        }
        $type = new type;
        $type->type = $request->type;
        $type->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ],201);
    }
    function update(Request $request, $id){
        try{
            $type = type::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "type not found"
            ],404);
        }
        if(type::where("type", $request->type)->exists()){
            return response()->json([
                "status"=> "error",
                "message"=> "type already exists"
            ],404);

        }
        $type->type = $request->type;
        $type->save();
        return response()->json([
            "status" => "success",
            "message"=> $request->all()
        ],201);
    }
    function read($id = null){
        if(empty($id)){
            $type = type::all();
            return response()->json([
                "status"=> "success",
                "message"=> $type->all()
            ],201);
        }
        try{
            $type = type::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No type found with the id: ".$id
            ],404);
        }
        return response()->json([
                "status"=> "success",
                "message"=> $type
            ],201);
        
    }
    function delete($id=null){
        try{
            $type = type::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "type not found"
            ],404);
        }
        $type->delete();
        return response()->json([
            "status"=> "success",
            "message"=> "type deleted"
        ],201);
    }
    public function getAllType()
    {
        $type = type::get();

        return response()->json(
            $type
        );
    }
}

