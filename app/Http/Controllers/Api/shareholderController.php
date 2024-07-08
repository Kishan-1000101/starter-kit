<?php

namespace App\Http\Controllers\Api;

use App\Models\Shareholder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShareholderController extends Controller
{
    public function index()
    {
        $shareholders = Shareholder::all();
        if ($shareholders->count() > 0) {
            return response()->json([
                'status' => 200,
                'shareholders' => $shareholders
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
            'shareholder_id' => 'required|exists:shareholder_metas,id',
            'tier_id' => 'required|exists:tiers,id',
            'start' => 'required|date_format:d M Y, h:i a',
            'end' => 'required|date_format:d M Y, h:i a',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create new shareholder instance
        $shareholder = Shareholder::create($request->all());

        // Return success response with the created shareholder data
        return response()->json([
            'status' => 201,
            'message' => 'Shareholder created successfully',
            'shareholder' => $shareholder
        ], 201);
    }

    public function show($shareholderId, $tierId)
    {
        $shareholder = Shareholder::where('shareholder_id', $shareholderId)
            ->where('tier_id', $tierId)
            ->first();

        if ($shareholder) {
            return response()->json([
                'status' => 200,
                'shareholder' => $shareholder
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such shareholder found'
            ], 404);
        }
    }

    public function update(Request $request, $shareholderId, $tierId)
    {
        $shareholder = Shareholder::where('shareholder_id', $shareholderId)
            ->where('tier_id', $tierId)
            ->first();

        if (!$shareholder) {
            return response()->json([
                'status' => 404,
                'message' => 'Shareholder not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'start' => 'required|date_format:d M Y, h:i a',
            'end' => 'required|date_format:d M Y, h:i a',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $shareholder->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Shareholder updated successfully',
            'shareholder' => $shareholder
        ], 200);
    }

    public function destroy($shareholderId, $tierId)
    {
        $shareholder = Shareholder::where('shareholder_id', $shareholderId)
            ->where('tier_id', $tierId)
            ->first();

        if ($shareholder) {
            $shareholder->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Shareholder deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such shareholder found'
            ], 404);
        }
    }
}
