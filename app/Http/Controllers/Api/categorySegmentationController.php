<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategorySegmentation;
use App\Models\Category;
use App\Models\Segmentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorySegmentationController extends Controller
{
    public function index()
    {
        $categorySegmentations = CategorySegmentation::all();
        if ($categorySegmentations->count() > 0) {
            return response()->json([
                'status' => 200,
                'categorySegmentations' => $categorySegmentations
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
            'category_id' => 'required|exists:categories,id',
            'segmentation_id' => 'required|exists:segmentations,id',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $category = Category::find($request->category_id);
        $segmentation = Segmentation::find($request->segmentation_id);

        $category->segmentations()->attach($segmentation);

        return response()->json([
            'status' => 201,
            'message' => 'Segmentation added to category successfully'
        ], 201);
    }

    public function destroy($category_id, $segmentation_id)
    {
        $category = Category::find($category_id);
        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found'
            ], 404);
        }

        $segmentation = Segmentation::find($segmentation_id);
        if (!$segmentation) {
            return response()->json([
                'status' => 404,
                'message' => 'Segmentation not found'
            ], 404);
        }

        $category->segmentations()->detach($segmentation);

        return response()->json([
            'status' => 200,
            'message' => 'Segmentation removed from category successfully'
        ], 200);
    }
}
