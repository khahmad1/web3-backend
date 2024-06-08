<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;
class companyController extends Controller
{
    function create(Request $request){
        $company = new company;
        $company->name = $request->name;
        $company->country = $request->country;
        $company->save();
        return response()->json([
            "status" => "success",
            "message"=> $request->all()
        ]);
    }
    function update(Request $request, $id){
        $company = company::find($id);
        $company->name = $request->name;
        $company->country = $request->country;
        $company->save();
        return response()->json([
            "status"=> "success",
            "message"=> $request->all()
        ]);
    }
    function read($id = null){
        if(empty($id)){
            $company = company::all();
            return response()->json([
                "status"=> "success",
                "message"=> $company->all()
            ]);
        }
        $company = company::find($id);
        return response()->json([
            "status"=> "success",
            "message"=> $company
        ]);
    }
    function delete($id){
        $company = company::find($id);
        $company->delete();
        return response()->json([
            "status"=> "success"
        ]);
    }
}
