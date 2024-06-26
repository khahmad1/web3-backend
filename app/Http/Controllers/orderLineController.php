<?php
namespace App\Http\Controllers;
use App\Models\medicine;
use Illuminate\Http\Request;
use App\Models\orderLine;
use App\Models\order;
class orderLineController extends Controller
{
    //
    function create(Request $request){
        $orderLine = new orderLine();
        $orderLine->price = $request->price;
        $medicine = medicine::find($request->medicine_id);
        $orderLine->medicine()->associate($medicine);
        $order = order::find($request->order_id);
        $orderLine->order()->associate($order);
        $orderLine->save();
        return response()->json([
            "status"=> "success",
            "message"=> $orderLine
        ]);
    }
    function read(Request $request, $id=null){
        if(empty($id)){
            return response()->json([
                "status"=> "success",
                "message"=> orderLine::all()
            ]);
        }
        $orderLine = orderLine::find($id);
        if(!$orderLine){
            return response()->json([
                "status"=> "error",
                "message"=> "No order line exists"
            ]);
        }
        return response()->json([
            "status"=> "success",
            "message"=> $orderLine
        ]);
    }
    function update(Request $request, $id){
        $orderLine = orderLine::find($id);
        if(!$orderLine){
            return response()->json([
                "status"=> "error",
                "message"=> "no order line exists"
            ]);
        }
        $orderLine->price = $request->price;
        $medicine = medicine::find($request->medicine_id);
        $orderLine->medicine()->associate($medicine);
        $order = order::find($request->order_id);
        $orderLine->order()->associate($order);
        $orderLine->save();
        return response()->json([
            "status"=> "success",
            "message"=> $orderLine
        ]);
    }   
    function delete(Request $request, $id){
        $orderLine = orderLine::find($id);
        if(!$orderLine){
            return response()->json([
                "status"=> "error",
                "message"=> "No order line exists"
            ]);
        }
        $orderLine->delete();
        return response()->json([
            "status"=> "success",
            "message"=> "order line deleted successfully"
        ]);
    }
}