<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        if ($items->count() > 0) {
            return response()->json([
                'status' => 200,
                'items' => $items
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
            'name' => 'required|string|max:50',
            'display_name' => 'nullable|string|max:255',
            'type' => 'required|string|max:50|default:string',
            'input_type' => 'nullable|string|max:20|default:text',
            'values' => 'nullable|json',
            'rules' => 'nullable|string',
            'disabled' => 'boolean|default:0',
            'prefix' => 'nullable|string|max:10',
            'suffix' => 'nullable|string|max:10',
            'groupingKey' => 'nullable|string|max:50|default:*',
            'parent' => 'nullable|integer',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new item instance
        $item = Item::create($request->all());

        // Return success response with the created item data
        return response()->json([
            'status' => 201,
            'message' => 'Item created successfully',
            'item' => $item
        ], 201);
    }

    public function show($id)
    {
        $item = Item::find($id);
        if ($item) {
            return response()->json([
                'status' => 200,
                'item' => $item
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such item found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json([
                'status' => 404,
                'message' => 'Item not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'display_name' => 'nullable|string|max:255',
            'type' => 'required|string|max:50|default:string',
            'input_type' => 'nullable|string|max:20|default:text',
            'values' => 'nullable|json',
            'rules' => 'nullable|string',
            'disabled' => 'boolean|default:0',
            'prefix' => 'nullable|string|max:10',
            'suffix' => 'nullable|string|max:10',
            'groupingKey' => 'nullable|string|max:50|default:*',
            'parent' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $item->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Item updated successfully',
            'item' => $item
        ], 200);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Item deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such item found'
            ], 404);
        }
    }
}
