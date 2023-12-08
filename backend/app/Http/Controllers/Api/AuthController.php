<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);

        if ($user) {
            return response()->json([
                'status' => 201,
                'message' => 'User registration successful, account created'
            ], 201);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'User registration failed'
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Nepareizs e-pasts vai parole'], 401);
        }

        $user = $request->user();
        $accessToken = $user->createToken('authToken')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $accessToken]);
    }

    public function logout (Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Veiksmīgi izlogojies']);
    }
}
