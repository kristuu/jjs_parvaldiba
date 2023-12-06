<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorseRequest;
use App\Models\Horse;

class HorseController extends Controller
{
    public function index()
    {
        return Horse::all();
    }

    public function store(HorseRequest $request)
    {
        return Horse::create($request->validated());
    }

    public function show(Horse $horse)
    {
        return $horse;
    }

    public function update(HorseRequest $request, Horse $horse)
    {
        $horse->update($request->validated());

        return $horse;
    }

    public function destroy(Horse $horse)
    {
        $horse->delete();

        return response()->json();
    }
}
