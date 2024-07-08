<?php

namespace App\Http\Controllers\Api;

use App\Models\ShareholderMeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShareholderMetaController extends Controller
{
    public function index()
    {
        $shareholderMetas = ShareholderMeta::all();
        if ($shareholderMetas->count() > 0) {
            return response()->json([
                'status' => 200,
                'shareholderMetas' => $shareholderMetas
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
            'comment' => 'nullable|string',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new shareholder meta instance
        $shareholderMeta = ShareholderMeta::create($request->all());

        // Return success response with the created shareholder meta data
        return response()->json([
            'status' => 201,
            'message' => 'Shareholder Meta created successfully',
            'shareholder_meta' => $shareholderMeta
        ], 201);
    }

    public function show($id)
    {
        $shareholderMeta = ShareholderMeta::find($id);
        if ($shareholderMeta) {
            return response()->json([
                'status' => 200,
                'shareholder_meta' => $shareholderMeta
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such shareholder meta found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $shareholderMeta = ShareholderMeta::find($id);
        if (!$shareholderMeta) {
            return response()->json([
                'status' => 404,
                'message' => 'Shareholder Meta not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $shareholderMeta->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Shareholder Meta updated successfully',
            'shareholder_meta' => $shareholderMeta
        ], 200);
    }

    public function destroy($id)
    {
        $shareholderMeta = ShareholderMeta::find($id);
        if ($shareholderMeta) {
            $shareholderMeta->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Shareholder Meta deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such shareholder meta found'
            ], 404);
        }
    }
}
