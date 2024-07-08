<?php

namespace App\Http\Controllers\Api;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::all();
        if ($technologies->count() > 0) {
            return response()->json([
                'status' => 200,
                'technologies' => $technologies
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:technologies',
            'parent' => 'nullable|exists:technologies,id'
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new technology instance
        $technology = Technology::create($request->all());

        // Return success response with the created technology data
        return response()->json([
            'status' => 201,
            'message' => 'Technology created successfully',
            'technology' => $technology
        ], 201);
    }

    public function show($id)
    {
        $technology = Technology::find($id);
        if ($technology) {
            return response()->json([
                'status' => 200,
                'technology' => $technology
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such technology found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $technology = Technology::find($id);
        if (!$technology) {
            return response()->json([
                'status' => 404,
                'message' => 'Technology not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:technologies,code,'.$id,
            'parent' => 'nullable|exists:technologies,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $technology->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Technology updated successfully',
            'technology' => $technology
        ], 200);
    }

    public function destroy($id)
    {
        $technology = Technology::find($id);
        if ($technology) {
            $technology->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Technology deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such technology found'
            ], 404);
        }
    }
}
