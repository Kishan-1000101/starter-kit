<?php

namespace App\Http\Controllers\Api;

use App\Models\TierType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TierTypeController extends Controller
{
    public function index()
    {
        $tierTypes = TierType::all();
        if ($tierTypes->count() > 0) {
            return response()->json([
                'status' => 200,
                'tierTypes' => $tierTypes
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
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new tier type instance
        $tierType = TierType::create($request->all());

        // Return success response with the created tier type data
        return response()->json([
            'status' => 201,
            'message' => 'Tier Type created successfully',
            'tierType' => $tierType
        ], 201);
    }

    public function show($id)
    {
        $tierType = TierType::find($id);
        if ($tierType) {
            return response()->json([
                'status' => 200,
                'tierType' => $tierType
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such tier type found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $tierType = TierType::find($id);
        if (!$tierType) {
            return response()->json([
                'status' => 404,
                'message' => 'Tier Type not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $tierType->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Tier Type updated successfully',
            'tierType' => $tierType
        ], 200);
    }

    public function destroy($id)
    {
        $tierType = TierType::find($id);
        if ($tierType) {
            $tierType->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Tier Type deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such tier type found'
            ], 404);
        }
    }
}
