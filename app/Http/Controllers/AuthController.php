<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        //'profile_image' => 'nullable|image|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    if ($request->hasFile('profile_image')) {
        $profileImage = $request->file('profile_image');
        $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
        $profileImage->storeAs('public/profile_images', $profileImageName);
        $user->profile_image = $profileImageName;
    }

    $user->save();

    Auth::login($user); // Log in the user

    return response()->json([
        'message' => 'Successfully registered'
    ], 201);
}
public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $credentials = $request->only(['email', 'password']);

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }

    $user = Auth::user(); // Get the authenticated user

    return response()->json([
        'user_id' => $user->id, // Return the user ID
        'message' => 'Successfully logged in'
    ], 200);
}


public function logout(Request $request)
{
    Auth::logout(); // Log out the user

    return response()->json([
        'message' => 'Successfully logged out'
    ]);
}

}
