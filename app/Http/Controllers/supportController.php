<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\support;
use Exception;

class supportController extends Controller
{
    //
    function create(Request $request){
        $support = new support;
        $support->name = $request->name;
        $support->message = $request->message;
        $support->email = $request->email;
        $support->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function update(Request $request, $id){
        $support =support::find($id);
        $support->name = $request->name;
        $support->message = $request->message;
        $support->email = $request->email;
        $support->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function read($id = null){
        if(empty($id)){
            $support = support::all();
            return response()->json([
                "status"=> "success",
                "message"=> $support->all()
            ]);
        }
        $support =support::find($id);
        return response()->json([
                "status"=> "success",
                "message"=> $support
            ]);
        
    }
    function delete($id){
        $support =support::find($id);
        $support->delete();
        return response()->json([
            "status"=> "success"
        ]);
    }
}
