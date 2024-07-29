<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }

    public function login(Request $request)
    {   
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'logo' => 'sometimes|file|mimes:jpeg,png,jpg,gif|max:2048',
            'is_admin' => 'sometimes|boolean'
        ]);
    
        $url = null;
        if ($request->hasFile('logo')) {
            $image_path = $request->file('logo')->store('logos', 'public');
            $url = Storage::url($image_path);
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,  
            'address' => $request->address,
            'is_admin' => $request->is_admin ?? false,
            'logo' => $url
        ]);
    
        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
    
    
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
    public function getAdmins()
{
    $adminUsers = User::where('is_admin', true)->get();

    return response()->json(
       $adminUsers
    );
}

public function getCustomers()
{
    $nonAdminUsers = User::where('is_admin', false)->get();

    return response()->json(
      $nonAdminUsers
    );
}
public function AdminRole(Request $request, $id)
    {
        $request->validate([
            'is_admin' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->is_admin = $request->is_admin;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Admin status updated successfully',
            'user' => $user
        ]);
    }
    public function deleteUser($id)
    {
        // Find the user by id
        $user = User::find($id);
    
        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Get all orders of the user
     $orders=   Order::where('user_id', $id);
    
        // Iterate through each order and delete the order lines
        foreach ($orders->get() as $order) {
            orderLine::where('order_id', $order->id)->delete();
        }
    
        // Delete the user's orders
        $orders->delete();
    
        // Delete the user
        $user->delete();
    
        return response()->json(['message' => 'User, their orders, and order lines have been deleted'], 200);
    }
    



}
