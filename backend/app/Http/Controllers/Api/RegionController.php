<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

class RegionController extends Controller
{
    public function index()
    {
        $users = User::all();

        if ($users->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $users
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No records found'
            ], 404);
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'password' => 'required|string|max:255',
            'phone' => 'required|integer|max:8',
            'iban' => 'required|string|max:64'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'birthdate' => $request->birthdate,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'iban_number' => $request->iban
            ]);

            if ($user) {

                return response()->json([
                    'status' => 200,
                    'message' => 'User created succesfully'
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'User creation failed'
                ], 500);
            }
        }
    }

    public function findByID(int $id)
    {
        $user = User::find($id);
        if ($user) {

            return response()->json([
                'status' => 200,
                'message' => $user
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No user with such id found'
            ], 404);
        }
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        if ($user) {

            return response()->json([
                'status' => 200,
                'message' => $user
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No such user found'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'password' => 'required|string|max:255',
            'phone' => 'required|integer|max:8',
            'iban' => 'required|string|max:64'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $user = User::find($id);

            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'birthdate' => $request->birthdate,
                    'email' => $request->email,
                    'password' => $request->password,
                    'phone' => $request->phone,
                    'iban_number' => $request->iban
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'User updated succesfully'
                ], 200);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'No such user found'
                ], 404);
            }
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return response()->json([
                'status' => 200,
                'message' => 'User with id ' . $id . ' deleted succesfully'
            ]);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No such user found'
            ], 404);
        }
    }

}
