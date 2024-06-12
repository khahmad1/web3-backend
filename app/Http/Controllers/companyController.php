<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class companyController extends Controller
{
    function create(Request $request){
        if(company::where("name", $request->name)->exists()){
            return response()->json([
                "status"=> "error",
                "message"=> "Company already exists with the name ".$request->name
            ],404);
        }
        $company = new company;
        $company->name = $request->name;
        $company->country = $request->country;
        $company->save();
        return response()->json([
            "status" => "success",
            "message"=> $request->all()
        ],201);
    }
    function update(Request $request, $id){        
        try{
            $company = company::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No company found with the id ".$id
            ],404);
        }
        
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
            ],201);
        }
        try{
            $company = company::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No company exists with the id ".$id
            ],404);
        }
        return response()->json([
            "status"=> "success",
            "message"=> $company
        ],201);
    }
    function delete($id){
        try{
            $company = company::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json([
                "status"=> "error",
                "message"=> "No company exists with the id ".$id
            ],404);
        }
        $company->delete();
        return response()->json([
            "status"=> "success",
            "message"=> "Company deleted"
        ],201);
    }
}
