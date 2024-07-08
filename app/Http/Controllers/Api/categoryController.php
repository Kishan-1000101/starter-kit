<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        if ($categories->count() > 0) {
            return response()->json([
                'status' => 200,
                'categories' => $categories
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
            'name' => 'required|string|max:255|unique:categories,name',
            // Add other validations as needed
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new category instance
        $category = Category::create($request->all());

        // Return success response with the created category data
        return response()->json([
            'status' => 201,
            'message' => 'Category created successfully',
            'category' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'status' => 200,
                'category' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such category found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            // Add other validations as needed
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $category->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Category updated successfully',
            'category' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Category deleted successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such category found'
            ], 404);
        }
    }
}
