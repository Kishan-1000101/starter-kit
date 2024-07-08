<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::all();
        if ($addresses->count() > 0) {
            return response()->json([
                'status' => 200,
                'addresses' => $addresses
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
            'lxn_id' => 'nullable|string|max:10',
            'street' => 'nullable|string',
            'street_no' => 'nullable|string|max:10',
            'building' => 'nullable|string',
            'floor' => 'nullable|string',
            'apartment' => 'nullable|string',
            'district' => 'nullable|string',
            'zip_code' => 'required|string|max:50',
            'city' => 'required|string',
            'country_alpha3' => 'required|string|size:3|exists:countries,alpha3',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new address instance
        $address = Address::create($request->all());

        // Return success response with the created address data
        return response()->json([
            'status' => 201,
            'message' => 'Address created successfully',
            'address' => $address
        ], 201);
    }

    public function show($id)
    {
        $address = Address::find($id);
        if ($address) {
            return response()->json([
                'status' => 200,
                'address' => $address
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such address found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        if (!$address) {
            return response()->json([
                'status' => 404,
                'message' => 'Address not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'lxn_id' => 'nullable|string|max:10',
            'street' => 'nullable|string',
            'street_no' => 'nullable|string|max:10',
            'building' => 'nullable|string',
            'floor' => 'nullable|string',
            'apartment' => 'nullable|string',
            'district' => 'nullable|string',
            'zip_code' => 'required|string|max:50',
            'city' => 'required|string',
            'country_alpha3' => 'required|string|size:3|exists:countries,alpha3',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $address->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Address updated successfully',
        ], 200);
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        if ($address) {
            $address->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Address deleted successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such address found'
            ], 404);
        }
    }
}
