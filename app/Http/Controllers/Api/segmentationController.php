<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Segmentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SegmentationController extends Controller
{
    public function index()
    {
        $segmentations = Segmentation::all();
        if ($segmentations->count() > 0) {
            return response()->json([
                'status' => 200,
                'segmentations' => $segmentations
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
            'price_rule' => 'nullable|json',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new segmentation instance
        $segmentation = Segmentation::create($request->all());

        // Return success response with the created segmentation data
        return response()->json([
            'status' => 201,
            'message' => 'Segmentation created successfully',
            'segmentation' => $segmentation
        ], 201);
    }

    public function show($id)
    {
        $segmentation = Segmentation::find($id);
        if ($segmentation) {
            return response()->json([
                'status' => 200,
                'segmentation' => $segmentation
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such segmentation found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $segmentation = Segmentation::find($id);
        if (!$segmentation) {
            return response()->json([
                'status' => 404,
                'message' => 'Segmentation not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price_rule' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $segmentation->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Segmentation updated successfully',
            'segmentation' => $segmentation
        ], 200);
    }

    public function destroy($id)
    {
        $segmentation = Segmentation::find($id);
        if ($segmentation) {
            $segmentation->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Segmentation deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such segmentation found'
            ], 404);
        }
    }
}
