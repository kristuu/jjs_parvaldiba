<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission_LevelRequest;
use App\Models\Permission_Level;

class Permission_LevelController extends Controller
{
    public function index()
    {
        return Permission_Level::all();
    }

    public function store(Permission_LevelRequest $request)
    {
        return Permission_Level::create($request->validated());
    }

    public function show(Permission_Level $permission_Level)
    {
        return $permission_Level;
    }

    public function update(Permission_LevelRequest $request, Permission_Level $permission_Level)
    {
        $permission_Level->update($request->validated());

        return $permission_Level;
    }

    public function destroy(Permission_Level $permission_Level)
    {
        $permission_Level->delete();

        return response()->json();
    }
}
