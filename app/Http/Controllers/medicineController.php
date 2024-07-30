<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\company;
use App\Models\medicine;
use App\Models\type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class medicineController extends Controller
{
    public function addMedicine(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required',
            'image' => 'required|image|max:2048',
            'category_id' => 'required|exists:category,id',
            'type_id' => 'required|exists:type,id',
            'company_id' => 'required|exists:company,id',
            'expiration_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 400);
        }

        $medicine = new Medicine();
        $medicine->name = $request->input('name');
        $medicine->quantity = $request->input('quantity');
        $medicine->price = $request->input('price'); // Assuming you pass the price in the request
        $image_path = $request->file('image')->store('images', 'public');
        $url = Storage::url($image_path);
        $medicine->image = $url;
        $category_id = $request->input('category_id');
        $category = category::find($category_id);
        $medicine->category()->associate($category);
        $type_id = $request->input('type_id');
        $type = type::find($type_id);
        $medicine->type()->associate($type);
        $company_id = $request->input('company_id');
        $company = company::find($company_id);
        $medicine->company()->associate($company);
        $medicine->expiration_date = $request->input('expiration_date');

        $medicine->save();

        return response()->json([
            'message' => 'Medicine created successfully!',
            'medicine' => $medicine,
        ]);
    }
    public function editMedicine(Request $request, $id)
    {
        try {
            // Retrieve the medicine record
            $medicine = Medicine::findOrFail($id);
    
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required',
                'quantity' => 'sometimes|required|integer',
                'price' => 'sometimes|required',
                'image' => 'sometimes|required|image|max:2048',
                'category_id' => 'sometimes|required|exists:category,id',
                'type_id' => 'sometimes|required|exists:type,id',
                'company_id' => 'sometimes|required|exists:company,id',
                'expiration_date' => 'sometimes|required|date',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 400);
            }
    
            // Update medicine details
            if ($request->hasFile('image')) {
                // Delete the old image
                if ($medicine->image) {
                    Storage::delete(str_replace('/storage/', '', $medicine->image));
                }
    
                // Save the new image
                $image_path = $request->file('image')->store('images', 'public');
                $url = Storage::url($image_path);
                $medicine->image = $url;
            }
    
            // Update basic attributes
            $updateData = $request->only([
                'name',
                'quantity',
                'price',
                'expiration_date',
            ]);
    
            foreach ($updateData as $key => $value) {
                if ($request->has($key)) {
                    $medicine->$key = $value;
                }
            }
    
            // Update category, type, and company associations
            if ($request->has('category_id')) {
                $medicine->category()->associate(Category::find($request->input('category_id')));
            }
            if ($request->has('type_id')) {
                $medicine->type()->associate(Type::find($request->input('type_id')));
            }
            if ($request->has('company_id')) {
                $medicine->company()->associate(Company::find($request->input('company_id')));
            }
    
            $medicine->save();
    
            return response()->json([
                'message' => 'Medicine updated successfully',
                'medicine' => $medicine,
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'error' => 'Error updating medicine: ' . $err->getMessage(),
            ], 500);
        }
    }
    
    public function getAllMedicine()
    {
        // Fetch all medicines with related category, type, and company information
        $medicines = Medicine::with(['category', 'type', 'company'])->get();
    
        return response()->json($medicines);
    }
    
    
    public function getMedicineByName($name)
    {
        try {
            // Find the medicine by name
            $medicine = medicine::where('name', $name)->firstOrFail();

            return response()->json([
                'medicine' => $medicine
            ], 200);
        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'error' => 'An error occurred while retrieving the medicine: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getMedicineByCategory($category_id)
    {
        try {
            // Fetch medicines directly from the medicine table where category_id matches
            $medicines = Medicine::where('category_id', $category_id)->with(['category', 'type', 'company'])->get();
    
            return response()->json(
                $medicines,
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while retrieving the medicines: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function deleteMedicine( $id)
    {
        $medicine = medicine::find( $id);
        if ($medicine) {
        $medicine->delete();
        $response = [
            
            'message' => 'Medicine deleted successfully!',
            
        ];
        return $response;
    } else {
        $error= [
            
            'message' => 'Medicine not found',
            
        ];
        return $error;
    }
}
}
