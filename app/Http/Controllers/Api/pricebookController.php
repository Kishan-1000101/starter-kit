<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pricebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PricebookController extends Controller
{
    public function index()
    {
        $pricebooks = Pricebook::all();
        if ($pricebooks->count() > 0) {
            return response()->json([
                'status' => 200,
                'pricebooks' => $pricebooks
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
            'name' => 'required|string|max:100',
            'version' => 'required|string|max:50',
            'segmentation_id' => 'nullable|exists:segmentations,id',
            'comment' => 'nullable|string',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new pricebook instance
        $pricebook = Pricebook::create($request->all());

        // Return success response with the created pricebook data
        return response()->json([
            'status' => 201,
            'message' => 'Pricebook created successfully',
            'pricebook' => $pricebook
        ], 201);
    }

    public function show($id)
    {
        $pricebook = Pricebook::find($id);
        if ($pricebook) {
            return response()->json([
                'status' => 200,
                'pricebook' => $pricebook
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such pricebook found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $pricebook = Pricebook::find($id);
        if (!$pricebook) {
            return response()->json([
                'status' => 404,
                'message' => 'Pricebook not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'version' => 'required|string|max:50',
            'segmentation_id' => 'nullable|exists:segmentations,id',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $pricebook->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Pricebook updated successfully',
            'pricebook' => $pricebook
        ], 200);
    }

    public function destroy($id)
    {
        $pricebook = Pricebook::find($id);
        if ($pricebook) {
            $pricebook->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Pricebook deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such pricebook found'
            ], 404);
        }
    }
}
