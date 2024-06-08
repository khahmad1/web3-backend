<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\type;
class typeController extends Controller
{
    function create(Request $request){
        $type = new type;
        $type->type = $request->type;
        $type->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function update(Request $request, $id){
        $type = type::find($id);
        $type->type = $request->type;
        $type->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function read($id = null){
        if(empty($id)){
            $type = type::all();
            return response()->json([
                "status"=> "success",
                "message"=> $type->all()
            ]);
        }
        $type =type::find($id);
        return response()->json([
                "status"=> "success",
                "message"=> $type
            ]);
        
    }
    function delete($id){
        $type =type::find($id);
        $type->delete();
        return response()->json([
            "status"=> "success"
        ]);
    }
}
