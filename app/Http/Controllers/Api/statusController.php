<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        if ($statuses->count() > 0) {
            return response()->json([
                'status' => 200,
                'statuses' => $statuses
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function show($id)
    {
        $status = Status::find($id);
        if ($status) {
            return response()->json([
                'status' => 200,
                'status' => $status
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such status found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'color' => 'nullable|string|max:25',
            'grouping_key' => 'nullable|string|max:50',
            'priority' => 'nullable|integer',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new status instance
        $status = Status::create($request->all());

        // Return success response with the created status data
        return response()->json([
            'status' => 201,
            'message' => 'Status created successfully',
            'status' => $status
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $status = Status::find($id);
        if (!$status) {
            return response()->json([
                'status' => 404,
                'message' => 'Status not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'color' => 'nullable|string|max:25',
            'grouping_key' => 'nullable|string|max:50',
            'priority' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $status->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Status updated successfully',
            'status' => $status
        ], 200);
    }

    public function destroy($id)
    {
        $status = Status::find($id);
        if ($status) {
            $status->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Status deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such status found'
            ], 404);
        }
    }
}
