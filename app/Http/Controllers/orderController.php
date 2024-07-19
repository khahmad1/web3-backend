<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\order;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class orderController extends Controller
{
    //
    function create(Request $request){
        $order = new order();
        $order->totalPrice = $request->totalPrice;
        $order->status = $request->status;
        $facility = User::find($request->facility_id);
        $order->user()->associate($facility);
        $order->message = $request->message;
        $order->save();
        return response()->json([
            "status"=> "success",
            "message"=> $order
        ]);
    }
    function read(Request $request, $id=null){
        if(empty($id)){
            return response()->json([
                "status"=> "error",
                "message"=> order::all()
            ]);
        }
        $order = Order::find($id);
        if(!$order){
            return response()->json([
                "status"=> "error",
                "message"=> "order does not exist"
            ]);
        }
        return response()->json([
            "status"=> "success",
            "message"=> $order
        ]);
    }
    function update(Request $request, $id){
        $order = Order::find($id);
        if(!$order){
            return response()->json([
                "status"=> "error",
                "message"=> "order does not exist"
            ]);
        }
        $order->totalPrice = $request->totalPrice;
        $order->date = $request->date;
        $order->status = $request->status;
        $facility = User::find($request->facility_id);
        $order->user()->associate($facility);
        $order->message = $request->message;
        $order->save();
        return response()->json([
            "status"=> "success",
            "message"=> $order
        ]);
    }
    function delete(Request $request, $id){
        $order = Order::find($id);
        if(!$order){
            return response()->json([
                "status"=> "error",
                "message"=> "order does not exist"
            ]);
        }
        $order->delete();
        return response()->json([
            "status"=> "success",
            "message"=> "order deleted"
        ]);
    }
    function getOrderByUser(Request $request, $id){
       $orders = order::where("facility_id", $id)->get();
       if($orders->isEmpty()){
        return response()->json([
            "status"=> "error",
            "message"=> "No user with id ".$id
        ],404);
        }  
       return response()->json([
        "status"=> "success",
        "message" => $orders
       ]);
        
    }
}