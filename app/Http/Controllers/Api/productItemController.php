<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductItemController extends Controller
{
    public function index()
    {
        $productItems = ProductItem::all();
        if ($productItems->count() > 0) {
            return response()->json([
                'status' => 200,
                'productItems' => $productItems
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

        // Create new product item instance
        $productItem = ProductItem::create($request->all());

        // Return success response with the created product item data
        return response()->json([
            'status' => 201,
            'message' => 'Product Item created successfully',
            'productItem' => $productItem
        ], 201);
    }

    public function show($productId, $itemId)
    {
        $productItem = ProductItem::where('product_id', $productId)
            ->where('item_id', $itemId)
            ->first();

        if ($productItem) {
            return response()->json([
                'status' => 200,
                'productItem' => $productItem
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such product item found'
            ], 404);
        }
    }

    public function update(Request $request, $productId, $itemId)
    {
        $productItem = ProductItem::where('product_id', $productId)
            ->where('item_id', $itemId)
            ->first();

        if (!$productItem) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Item not found',
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

        $productItem->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Product Item updated successfully',
            'productItem' => $productItem
        ], 200);
    }

    public function destroy($productId, $itemId)
    {
        $productItem = ProductItem::where('product_id', $productId)
            ->where('item_id', $itemId)
            ->first();

        if ($productItem) {
            $productItem->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Product Item deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such product item found'
            ], 404);
        }
    }
}
