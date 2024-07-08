<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductReferenceController extends Controller
{
    public function index()
    {
        $productReferences = ProductReference::all();
        if ($productReferences->count() > 0) {
            return response()->json([
                'status' => 200,
                'productReferences' => $productReferences
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
            // Add validation rules as needed
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new product reference instance
        $productReference = ProductReference::create($request->all());

        // Return success response with the created product reference data
        return response()->json([
            'status' => 201,
            'message' => 'Product Reference created successfully',
            'productReference' => $productReference
        ], 201);
    }

    public function show($productId, $referenceId)
    {
        $productReference = ProductReference::where('product_id', $productId)
            ->where('reference_id', $referenceId)
            ->first();

        if ($productReference) {
            return response()->json([
                'status' => 200,
                'productReference' => $productReference
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such product reference found'
            ], 404);
        }
    }

    public function update(Request $request, $productId, $referenceId)
    {
        $productReference = ProductReference::where('product_id', $productId)
            ->where('reference_id', $referenceId)
            ->first();

        if (!$productReference) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Reference not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            // Add validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $productReference->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Product Reference updated successfully',
            'productReference' => $productReference
        ], 200);
    }

    public function destroy($productId, $referenceId)
    {
        $productReference = ProductReference::where('product_id', $productId)
            ->where('reference_id', $referenceId)
            ->first();

        if ($productReference) {
            $productReference->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Product Reference deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such product reference found'
            ], 404);
        }
    }
}
