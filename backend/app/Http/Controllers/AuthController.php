<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        try {
            $request["email"] = strtolower($request["email"]);
            $data = $request->validate([
                "name" => ["required"],
                "email" => ["required", "email", "unique:users"],
                "password" => ["required", "confirmed"]
            ]);

            User::create($data);
            return response()->json(["message" => "Register Success"], 201);
        } catch (Exception $error) {
            return response()->json(["message" => $error->getMessage()], 400);
        }
    }

    public function login(Request $request) {
        try {
            $request->validate([
                "email" => ["required", "email"],
                "password" => ["required"]
            ]);

            $user = User::where("email", $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(["message" => "Invalid Credentials"], 401);
            }

            $token = $user->createToken($user->name)->plainTextToken;
            return response()->json([
                "message" => "Login Success",
                "token" => $token,
                "account_status" => $user->account_status
            ], 200);

        } catch (Exception $error) {
            return response()->json(["message" => $error->getMessage()], 400);
        }
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(["message" => "Logout Success"], 200);
    }
}
