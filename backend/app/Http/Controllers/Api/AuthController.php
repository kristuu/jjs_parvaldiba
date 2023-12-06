<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::where('email', $requestData['email'])->first();
        if (!$user || !Hash::check($requestData['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorised Access'], 401);
        }
        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['user' => $user, 'access_token' => $accessToken], 200);
    }

    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json(['user' => $user], 200);
    }
    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response()->json($response, 200);
    }
}
