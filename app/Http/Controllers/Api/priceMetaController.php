<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PriceMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceMetaController extends Controller
{
    public function index()
    {
        $priceMetas = PriceMeta::all();
        if ($priceMetas->count() > 0) {
            return response()->json([
                'status' => 200,
                'priceMetas' => $priceMetas
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

        // Create new price meta instance
        $priceMeta = PriceMeta::create($request->all());

        // Return success response with the created price meta data
        return response()->json([
            'status' => 201,
            'message' => 'Price Meta created successfully',
            'priceMeta' => $priceMeta
        ], 201);
    }

    public function show($id)
    {
        $priceMeta = PriceMeta::find($id);
        if ($priceMeta) {
            return response()->json([
                'status' => 200,
                'priceMeta' => $priceMeta
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such price meta found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $priceMeta = PriceMeta::find($id);
        if (!$priceMeta) {
            return response()->json([
                'status' => 404,
                'message' => 'Price Meta not found',
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

        $priceMeta->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Price Meta updated successfully',
            'priceMeta' => $priceMeta
        ], 200);
    }

    public function destroy($id)
    {
        $priceMeta = PriceMeta::find($id);
        if ($priceMeta) {
            $priceMeta->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Price Meta deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such price meta found'
            ], 404);
        }
    }
}
