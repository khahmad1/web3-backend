<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
class categoryController extends Controller
{
    //
    function create(Request $request){
        $category = new category;
        $category->name = $request->name;
        $category->save();
        return response()->json([
            "status" => "success",
            "message"=> $request->all()
        ]);
    }
    function update(Request $request, $id){
        $category = category::find($id);
        $category->name = $request->name;
        $category->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function read($id = null){
        if(empty($id)){
            $category = category::all();
            return response()->json([
                "status"=> "success",
                "message"=> $category->all()
            ]);
        }
        $category = category::find($id);
        return response()->json([
            "status"=> "success",
            "message"=> $category
        ]);
    }
    function delete($id){
        $category = category::find($id);
        $category->delete();
        return response()->json([
            "status"=> "success"
        ]);
    }
}
