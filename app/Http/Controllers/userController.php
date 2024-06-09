<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use function Laravel\Prompts\warning;

class userController extends Controller
{
    function create(Request $request){
        $User = new User;
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = bcrypt($request->password);
        $User->phone = $request->phone;
        $User->logo = $request->logo;
        $User->type = $request->type;
        $User->address_id = $request->address_id;
        $User->role_id = $request->role_id;
        $User->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function update(Request $request, $id){
        $User = User::find($id);
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = bcrypt($request->password);
        $User->phone = $request->phone;
        $User->logo = $request->logo;
        $User->type = $request->type;
        $User->address_id = $request->address_id;
        $User->role_id = $request->role_id;
        $User->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function read($id = null){
        if(empty($id)){
            $User = User::all();
            return response()->json([
                "status"=> "success",
                "message"=> $User->all()
            ]);
        }
        $User =User::find($id);
        return response()->json([
                "status"=> "success",
                "message"=> $User
            ]);
        
    }
    function delete($id){
        $User =User::find($id);
        $User->delete();
        return response()->json([
            "status"=> "success"
        ]);
    }

}