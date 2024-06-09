<?php

namespace App\Http\Controllers;
use App\Models\address;
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
        ]);
    }
    function update(Request $request, $id){
        $address = address::find($id);
        $address->city = $request->city;
        $address->country = $request->country;
        $address->street = $request->street;
        $address->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function read($id = null){
        if(empty($id)){
            $address = address::all();
            return response()->json([
                "status"=> "success",
                "message"=> $address->all()
            ]);
        }
        $address = address::find($id);
        if(!$address){
            return response()->json([
                "status"=> "failed",
                "message" => "Address does not exist"
            ]);
        }
        return response()->json([
            "status"=> "success",
            "message"=> $address
        ]);
    }
    function delete($id){
        $address = address::find($id);
        $address->delete();
        return response()->json([
            "status"=> "success",
            "message" => "Address deleted"
        ]);
    }
}
