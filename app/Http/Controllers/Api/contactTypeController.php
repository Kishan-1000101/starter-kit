<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactTypeController extends Controller
{
    public function index()
    {
        $contactTypes = ContactType::all();
        if ($contactTypes->count() > 0) {
            return response()->json([
                'status' => 200,
                'contactTypes' => $contactTypes
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
            'name' => 'required|string|max:191',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new contact type instance
        $contactType = ContactType::create($request->all());

        // Return success response with the created contact type data
        return response()->json([
            'status' => 201,
            'message' => 'Contact Type created successfully',
            'contactType' => $contactType
        ], 201);
    }

    public function show($id)
    {
        $contactType = ContactType::find($id);
        if ($contactType) {
            return response()->json([
                'status' => 200,
                'contactType' => $contactType
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such contact type found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $contactType = ContactType::find($id);
        if (!$contactType) {
            return response()->json([
                'status' => 404,
                'message' => 'Contact Type not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $contactType->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Contact Type updated successfully',
            'contactType' => $contactType
        ], 200);
    }

    public function destroy($id)
    {
        $contactType = ContactType::find($id);
        if ($contactType) {
            $contactType->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Contact Type deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such contact type found'
            ], 404);
        }
    }
}
