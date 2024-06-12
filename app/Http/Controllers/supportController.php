<?php
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\support;
use Exception;

class supportController extends Controller
{
    //
    function create(Request $request){
        if(support::where("email", $request->email)->exists()){
            return response()->json([
                "status"=>"error",
                "message"=> "Support already exists with that email"
            ],404);
        }
        $support = new support;
        $support->name = $request->name;
        $support->message = $request->message;
        $support->email = $request->email;
        $support->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ],201);
    }
    function update(Request $request, $id){
        try{
            $support = support::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No support exists with the id: ".$id
            ] ,404);
        }
        if(support::where("email", $request->email)->exists()){
            return response()->json([
                "status"=> "error",
                "message"=> "Email already in use"
            ],404);
        }
        $support->name = $request->name;
        $support->message = $request->message;
        $support->email = $request->email;
        $support->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ],201);
    }
    function read($id = null){
        if(empty($id)){
            $support = support::all();
            return response()->json([
                "status"=> "success",
                "message"=> $support->all()
            ],201);
        }
        try{
            $support = support::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No support exists with the id: ".$id
            ] ,404);
        }
        return response()->json([
                "status"=> "success",
                "message"=> $support
            ],201);
        
    }
    function delete($id){
        try{
            $support = support::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No support exists with the id: ".$id
            ] ,404);
        }
        $support->delete();
        return response()->json([
            "status"=> "success",
            "message"=> "Support Deleted"
        ],201);
    }
}
