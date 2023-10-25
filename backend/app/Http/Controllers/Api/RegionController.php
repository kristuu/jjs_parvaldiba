<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();

        if ($regions->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $regions
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
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $region = Region::create([
                'name' => $request->name
            ]);

            if ($region) {

                return response()->json([
                    'status' => 200,
                    'message' => 'Region created succesfully'
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Region creation failed'
                ], 500);
            }
        }
    }

    public function findByID(int $id)
    {
        $region = Region::find($id);
        if ($region) {

            return response()->json([
                'status' => 200,
                'message' => $region
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No region with such id found'
            ], 404);
        }
    }

    public function edit(int $id)
    {
        $region = Region::find($id);
        if ($region) {

            return response()->json([
                'status' => 200,
                'message' => $region
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No such region found'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $region = Region::find($id);

            if ($region) {
                $region->update([
                    'name' => $request->name
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Region updated succesfully'
                ], 200);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'No such region found'
                ], 404);
            }
        }
    }

    public function delete($id)
    {
        $region = Region::find($id);

        if ($region) {
            $region->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Region with id ' . $id . ' deleted succesfully'
            ]);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No such region found'
            ], 404);
        }
    }

}
