<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorRequest;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function index()
    {
        return Instructor::all();
    }

    public function store(InstructorRequest $request)
    {
        return Instructor::create($request->validated());
    }

    public function show(Instructor $instructor)
    {
        return $instructor;
    }

    public function update(InstructorRequest $request, Instructor $instructor)
    {
        $instructor->update($request->validated());

        return $instructor;
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return response()->json();
    }
}
