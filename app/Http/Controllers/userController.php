<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

use function Laravel\Prompts\warning;

class userController extends Controller
{
    function create(Request $request){
        if(User::where("email", $request->email)->exists()){
            return response()->json([
                "status"=>"error",
                "message"=> "User already exists"
            ],404);
        }
        $User = new User;
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = bcrypt($request->password);
        $User->phone = $request->phone;
        $User->logo = $request->logo;
        $User->address_id = $request->address_id;
        $User->role_id = $request->role_id;
        $User->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ],201);
    }
    function update(Request $request, $id){
        $User = User::find($id);
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = bcrypt($request->password);
        $User->phone = $request->phone;
        $User->logo = $request->logo;
        $User->address_id = $request->address_id;
        $User->role_id = $request->role_id;
        $User->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ],201);
    }
    function read($id = null){
        if(empty($id)){
            $User = User::all();
            return response()->json([
                "status"=> "success",
                "message"=> $User->all()
            ],201);
        }
        $User =User::find($id);
        return response()->json([
                "status"=> "success",
                "message"=> $User
            ],201);
        
    }
    function delete($id){
        $User =User::find($id);
        $User->delete();
        return response()->json([
            "status"=> "success"
        ],201);
    }
}