<?php

namespace App\Http\Controllers;

use App\Http\Requests\BreedRequest;
use App\Models\Breed;

class BreedController extends Controller
{
    public function index()
    {
        return Breed::all();
    }

    public function store(BreedRequest $request)
    {
        return Breed::create($request->validated());
    }

    public function show(Breed $breed)
    {
        return $breed;
    }

    public function update(BreedRequest $request, Breed $breed)
    {
        $breed->update($request->validated());

        return $breed;
    }

    public function destroy(Breed $breed)
    {
        $breed->delete();

        return response()->json();
    }
}
