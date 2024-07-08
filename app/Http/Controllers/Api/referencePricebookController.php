<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReferencePricebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferencePricebookController extends Controller
{
    public function index()
    {
        $referencePricebooks = ReferencePricebook::all();
        if ($referencePricebooks->count() > 0) {
            return response()->json([
                'status' => 200,
                'referencePricebooks' => $referencePricebooks
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

        // Create new reference pricebook instance
        $referencePricebook = ReferencePricebook::create($request->all());

        // Return success response with the created reference pricebook data
        return response()->json([
            'status' => 201,
            'message' => 'Reference Pricebook created successfully',
            'referencePricebook' => $referencePricebook
        ], 201);
    }

    public function show($pricebookId, $referenceId)
    {
        $referencePricebook = ReferencePricebook::where('pricebook_id', $pricebookId)
            ->where('reference_id', $referenceId)
            ->first();

        if ($referencePricebook) {
            return response()->json([
                'status' => 200,
                'referencePricebook' => $referencePricebook
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such reference pricebook found'
            ], 404);
        }
    }

    public function update(Request $request, $pricebookId, $referenceId)
    {
        $referencePricebook = ReferencePricebook::where('pricebook_id', $pricebookId)
            ->where('reference_id', $referenceId)
            ->first();

        if (!$referencePricebook) {
            return response()->json([
                'status' => 404,
                'message' => 'Reference Pricebook not found',
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

        $referencePricebook->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Reference Pricebook updated successfully',
            'referencePricebook' => $referencePricebook
        ], 200);
    }

    public function destroy($pricebookId, $referenceId)
    {
        $referencePricebook = ReferencePricebook::where('pricebook_id', $pricebookId)
            ->where('reference_id', $referenceId)
            ->first();

        if ($referencePricebook) {
            $referencePricebook->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Reference Pricebook deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such reference pricebook found'
            ], 404);
        }
    }
}
