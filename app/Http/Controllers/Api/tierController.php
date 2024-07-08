<?php

namespace App\Http\Controllers\Api;

use App\Models\Tier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TierController extends Controller
{
    public function index()
    {
        $tiers = Tier::all();
        if ($tiers->count() > 0) {
            return response()->json([
                'status' => 200,
                'tiers' => $tiers
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
            'segmentation_id' => 'nullable|integer',
            'tier_id' => 'nullable|integer',
            'tier_type_id' => 'required|integer|exists:tier_types,id',
            'tierable_type' => 'required|string|max:255',
            'tierable_id' => 'required|integer',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new tier instance
        $tier = Tier::create($request->all());

        // Return success response with the created tier data
        return response()->json([
            'status' => 201,
            'message' => 'Tier created successfully',
            'tier' => $tier
        ], 201);
    }

    public function show($id)
    {
        $tier = Tier::find($id);
        if ($tier) {
            return response()->json([
                'status' => 200,
                'tier' => $tier
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such tier found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $tier = Tier::find($id);
        if (!$tier) {
            return response()->json([
                'status' => 404,
                'message' => 'Tier not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'segmentation_id' => 'nullable|integer',
            'tier_id' => 'nullable|integer',
            'tier_type_id' => 'required|integer|exists:tier_types,id',
            'tierable_type' => 'required|string|max:255',
            'tierable_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $tier->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Tier updated successfully',
            'tier' => $tier
        ], 200);
    }

    public function destroy($id)
    {
        $tier = Tier::find($id);
        if ($tier) {
            $tier->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Tier deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such tier found'
            ], 404);
        }
    }
}
