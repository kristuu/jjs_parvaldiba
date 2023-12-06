<?php

namespace App\Http\Controllers;

use App\Http\Requests\users_permission_levelRequest;
use App\Models\users_permission_level;

class users_permission_levelController extends Controller
{
    public function index()
    {
        return users_permission_level::all();
    }

    public function store(users_permission_levelRequest $request)
    {
        return users_permission_level::create($request->validated());
    }

    public function show(users_permission_level $users_permission_level)
    {
        return $users_permission_level;
    }

    public function update(users_permission_levelRequest $request, users_permission_level $users_permission_level)
    {
        $users_permission_level->update($request->validated());

        return $users_permission_level;
    }

    public function destroy(users_permission_level $users_permission_level)
    {
        $users_permission_level->delete();

        return response()->json();
    }
}
