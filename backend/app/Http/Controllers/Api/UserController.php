<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Session;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

class UserController extends Controller
{

    public function login(UserRequest $request)
    {
        $credentials = [
          'email' => $request->email,
          'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $status = 200;
            $message = 'Autorizācija notikusi veiksmīgi';
        } else {
            $status = 401;
            $message = 'Autorizācija neveiksmīga';
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ], $status);

    }

    public function logout()
    {
        try {
            Session:flush();
            $status = 200;
            $message = 'Sesija beidzēta';
        } catch (\Illuminate\Database\QueryException $ex) {
            $status = 404;
            $message = 'Neizdevās beidzēt sesiju';
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ], $status);
    }

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

    public function store(UserRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $password = time().rand();

        $user = User::create([
            'person_code' => $validated['person_code'],
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'birthdate' => $validated['birthdate'],
            'email' => $validated['email'],
            'password' => bcrypt($password),
            'phone' => $validated['phone'],
            'googleplaces_address_code' => $request->googleplaces_address_code,
            'iban_code' => $validated['iban_code']
        ]);

        if ($user) {
            return response()->json([
                'status' => 200,
                'message' => 'User created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'User creation failed'
            ], 500);
        }
    }

    public function findByID(string $person_code)
    {
        $user = User::find($person_code);
        if ($user) {

            return response()->json([
                'status' => 200,
                'message' => $user
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No user with such person code found'
            ], 404);
        }
    }

    public function edit(?string $person_code)
    {
        $user = User::where('person_code', $person_code)->first();
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

    public function update(UserRequest $request, string $person_code)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $user = User::find($person_code);

        if ($user) {
            $user->update([
                'person_code' => $validated['person_code'],
                'name' => $validated['name'],
                'surname' => $validated['surname'],
                'birthdate' => $validated['birthdate'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'googleplaces_address_code' => $request->googleplaces_address_code,
                'iban_code' => $validated['iban_code']
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

    public function delete(string $person_code)
    {
        $user = User::find($person_code);

        if ($user) {
            $user->delete();

            return response()->json([
                'status' => 200,
                'message' => 'User with person code ' . $person_code . ' deleted succesfully'
            ]);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No such user found'
            ], 404);
        }
    }

}
