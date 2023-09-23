<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens;

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required',
           
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        
        // Generate a new API token for the user
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $request->only('name', 'password');


        if (Auth::attempt($credentials)) {
            // Authentication successful


            // Get the authenticated user
            $user = Auth::user();

            // Revoke existing tokens
            $user->tokens()->delete();

            // Generate a new API token for the user
            $token = $user->createToken('api-token')->plainTextToken;

            // Return the token as a response
            return response()->json(['token' => $token], 200);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function user(Request $request)
    {
        // Authenticate the user using the provided token
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Return the user information
        return response()->json(['user' => $user], 200);
    }

  public function logout(Request $request)
    {
        // Authenticate the user using the provided token
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Revoke the user's token
        $user = Auth::user();
        $user->tokens()->delete();

        // Return a success message
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required',
           
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(['success'], 200);
    }

    function displayUser(){
        return User::all();
    
    }

    function displaySpecificUser($id){
        return User::find($id);
    }

    function deleteUser($id){
        return User::where('id', $id)->delete();

    }

    
    function updateUser( Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required',
           
       ]);

       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 422);
       }

       $user = User::findOrFail($id);
       $user->name = $request->input('name');
       $user->password=$request->input('password');
       $user->save();

       return response()->json(["success"], 200);
}


}
