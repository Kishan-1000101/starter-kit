<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferenceController extends Controller
{
    public function index()
    {
        $references = Reference::all();
        if ($references->count() > 0) {
            return response()->json([
                'status' => 200,
                'references' => $references
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

        // Create new reference instance
        $reference = Reference::create($request->all());

        // Return success response with the created reference data
        return response()->json([
            'status' => 201,
            'message' => 'Reference created successfully',
            'reference' => $reference
        ], 201);
    }

    public function show($id)
    {
        $reference = Reference::find($id);
        if ($reference) {
            return response()->json([
                'status' => 200,
                'reference' => $reference
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such reference found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $reference = Reference::find($id);
        if (!$reference) {
            return response()->json([
                'status' => 404,
                'message' => 'Reference not found',
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

        $reference->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Reference updated successfully',
            'reference' => $reference
        ], 200);
    }

    public function destroy($id)
    {
        $reference = Reference::find($id);
        if ($reference) {
            $reference->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Reference deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such reference found'
            ], 404);
        }
    }
}
