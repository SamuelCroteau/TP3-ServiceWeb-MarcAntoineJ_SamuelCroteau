<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'last_name' => 'required',
                'first_name' => 'required',
                'login' => 'required'
            ]);
            $user = User::create([
                'login' => $request->login,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'role_id' => 1
            ]);
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], CREATED);
        } catch (ValidationException $ex) {
            abort(INVALID_DATA, $ex->getMessage());
        } catch (Exception $ex) {
            abort(SERVER_ERROR, $ex->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'login' => 'required',
                'password' => 'required',
            ]);
            if (!Auth::attempt($request->only('login', 'password'))) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
            $user = Auth::user();
            $token = $user->createToken($user->login);
            return ['token' => $token->plainTextToken];
        } catch (ValidationException $ex) {
            abort(INVALID_DATA, $ex->getMessage());
        } catch (Exception $ex) {
            abort(SERVER_ERROR, $ex->getMessage());
        }
    }
    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            $user->tokens()->delete();
            return response()->noContent();
        } catch (Exception $ex) {
            abort(SERVER_ERROR, $ex->getMessage());
        }
    }

}
