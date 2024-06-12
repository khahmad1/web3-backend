<?php

namespace App\Http\Controllers;
use App\Models\address;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class addressController extends Controller
{
    function create(Request $request){
        $address = new address;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->street = $request->street;
        $address->save();
        return response()->json([
            "status" => "success",
            "message"=> $request->all()
        ],201);
    }
    function update(Request $request, $id){
        try{
            $address = address::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "Address with the id ".$id." does not exist"
            ],404);
        }
        $address->city = $request->city;
        $address->country = $request->country;
        $address->street = $request->street;
        $address->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ],201);
    }
    function read($id = null){
        if(empty($id)){
            $address = address::all();
            return response()->json([
                "status"=> "success",
                "message"=> $address->all()
            ],201);
        }
        try{
            $address = address::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "Address with the id ".$id." does not exist"
            ],404);
        }
        
        return response()->json([
            "status"=> "success",
            "message"=> $address
        ],201);
    }
    function delete($id){
        try{
            $address = address::find($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "Address with the id ".$id." does not exist"
            ],404);
        }
        $address->delete();
        return response()->json([
            "status"=> "success",
            "message" => "Address deleted"
        ],201);
    }
}
