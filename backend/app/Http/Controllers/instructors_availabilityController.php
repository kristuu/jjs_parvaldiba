<?php

namespace App\Http\Controllers;

use App\Http\Requests\instructors_availabilityRequest;
use App\Models\instructors_availability;

class instructors_availabilityController extends Controller
{
    public function index()
    {
        return instructors_availability::all();
    }

    public function store(instructors_availabilityRequest $request)
    {
        return instructors_availability::create($request->validated());
    }

    public function show(instructors_availability $instructors_availability)
    {
        return $instructors_availability;
    }

    public function update(instructors_availabilityRequest $request, instructors_availability $instructors_availability)
    {
        $instructors_availability->update($request->validated());

        return $instructors_availability;
    }

    public function destroy(instructors_availability $instructors_availability)
    {
        $instructors_availability->delete();

        return response()->json();
    }
}
