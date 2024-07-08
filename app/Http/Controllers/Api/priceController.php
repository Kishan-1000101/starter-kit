<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::all();
        if ($prices->count() > 0) {
            return response()->json([
                'status' => 200,
                'prices' => $prices
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

        // Create new price instance
        $price = Price::create($request->all());

        // Return success response with the created price data
        return response()->json([
            'status' => 201,
            'message' => 'Price created successfully',
            'price' => $price
        ], 201);
    }

    public function show($id)
    {
        $price = Price::find($id);
        if ($price) {
            return response()->json([
                'status' => 200,
                'price' => $price
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such price found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $price = Price::find($id);
        if (!$price) {
            return response()->json([
                'status' => 404,
                'message' => 'Price not found',
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

        $price->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Price updated successfully',
            'price' => $price
        ], 200);
    }

    public function destroy($id)
    {
        $price = Price::find($id);
        if ($price) {
            $price->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Price deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such price found'
            ], 404);
        }
    }
}
