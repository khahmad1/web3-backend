<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\category;
class categoryController extends Controller
{
    //
    function create(Request $request){
        if(category::where("name",$request->name)->exists()){
            return response()->json([
                "status"=> "error",
                "message"=> "category with the name ".$request->name." already exists"
            ],404);
        }
        $category = new category;
        $category->name = $request->name;
        $category->save();
        return response()->json([
            "status" => "success",
            "message"=> $request->all()
        ],201);
    }
    function update(Request $request, $id){
        try{
            $category = category::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "category with the id ".$id." does not exist"
            ],404);
        }
        if(category::where("name",$request->name)->exists()){
            return response()->json([
                "status"=> "error",
                "message"=> "A category with the name ".$request->name." already exists"
            ],404);
        }
        $category->name = $request->name;
        $category->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ],201);
    }
    function read($id = null){
        if(empty($id)){
            $category = category::all();
            return response()->json([
                "status"=> "success",
                "message"=> $category->all()
            ],201);
        }
        try{
            $category = category::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "Category with the id ".$id." does not exist"
            ],404);
        }
        return response()->json([
            "status"=> "success",
            "message"=> $category
        ],201);
    }
    function delete($id){
        try{
            $category = category::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "Category with the id ".$id." does not exist"
            ],404);
        }
        $category->delete();
        return response()->json([
            "status"=> "success"
        ],201);
    }
    public function getAllCategory()
    {
        $category = category::get();

        return response()->json(
            $category
        );
    }
}
