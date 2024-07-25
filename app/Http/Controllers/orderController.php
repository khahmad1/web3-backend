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
        return response()->json( $order
        );
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
    function updateStatus(Request $request, $id) {
        // Validate the incoming request to ensure the status is provided
        $request->validate([
            'status' => 'required|string'
        ]);
    
        // Find the order by ID
        $order = Order::find($id);
    
        // Check if the order exists
        if (!$order) {
            return response()->json([
                "status" => "error",
                "message" => "Order does not exist"
            ], 404);
        }
    
        // Update the status field
        $order->status = $request->status;
    
        // Save the changes to the order
        $order->save();
    
        // Return a success response with the updated order
        return response()->json([
            "status" => "success",
            "message" => $order
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
       $orders = order::where("user_id", $id)->get();
       if($orders->isEmpty()){
        return response()->json([
            "status"=> "error",
            "message"=> "No user with id ".$id
        ],404);
        }  
       return response()->json(
        $orders
       );
        
    }  public function getAllOrder()
    {
        // Fetch all medicines with related category, type, and company information
        $orders = order::with('user')->get();
    
        return response()->json($orders);
    }


}