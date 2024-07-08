<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PricebookTier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PricebookTierController extends Controller
{
    public function index()
    {
        $pricebookTiers = PricebookTier::all();
        if ($pricebookTiers->count() > 0) {
            return response()->json([
                'status' => 200,
                'pricebookTiers' => $pricebookTiers
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
            'pricebook_id' => 'required|exists:pricebooks,id',
            'tier_id' => 'required|exists:tiers,id',
            'start' => 'required|date',
            'end' => 'nullable|date',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new pricebook tier instance
        $pricebookTier = PricebookTier::create($request->all());

        // Return success response with the created pricebook tier data
        return response()->json([
            'status' => 201,
            'message' => 'Pricebook Tier created successfully',
            'pricebookTier' => $pricebookTier
        ], 201);
    }

    public function show($id)
    {
        $pricebookTier = PricebookTier::find($id);
        if ($pricebookTier) {
            return response()->json([
                'status' => 200,
                'pricebookTier' => $pricebookTier
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such pricebook tier found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $pricebookTier = PricebookTier::find($id);
        if (!$pricebookTier) {
            return response()->json([
                'status' => 404,
                'message' => 'Pricebook Tier not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'pricebook_id' => 'required|exists:pricebooks,id',
            'tier_id' => 'required|exists:tiers,id',
            'start' => 'required|date',
            'end' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $pricebookTier->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Pricebook Tier updated successfully',
            'pricebookTier' => $pricebookTier
        ], 200);
    }

    public function destroy($id)
    {
        $pricebookTier = PricebookTier::find($id);
        if ($pricebookTier) {
            $pricebookTier->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Pricebook Tier deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such pricebook tier found'
            ], 404);
        }
    }
}
