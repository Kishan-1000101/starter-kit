<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        if ($companies->count() > 0) {
            return response()->json([
                'status' => 200,
                'companies' => $companies
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
            'tier_id' => 'nullable|integer|exists:tiers,id',
            'name' => 'required|string|max:255',
            'legal_form' => 'nullable|string|max:20',
            'registration_number' => 'nullable|string|max:255',
            'vat_number' => 'nullable|string|max:255',
            'address_id' => 'nullable|integer|exists:addresses,id',
            'fixed_phone' => 'nullable|string|max:50',
            'email' => 'nullable|string|max:255|email',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new company instance
        $company = Company::create($request->all());

        // Return success response with the created company data
        return response()->json([
            'status' => 201,
            'message' => 'Company created successfully',
            'company' => $company
        ], 201);
    }

    public function show($id)
    {
        $company = Company::find($id);
        if ($company) {
            return response()->json([
                'status' => 200,
                'company' => $company
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such company found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json([
                'status' => 404,
                'message' => 'Company not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tier_id' => 'nullable|integer|exists:tiers,id',
            'name' => 'required|string|max:255',
            'legal_form' => 'nullable|string|max:20',
            'registration_number' => 'nullable|string|max:255',
            'vat_number' => 'nullable|string|max:255',
            'address_id' => 'nullable|integer|exists:addresses,id',
            'fixed_phone' => 'nullable|string|max:50',
            'email' => 'nullable|string|max:255|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $company->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Company updated successfully',
            'company' => $company
        ], 200);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Company deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such company found'
            ], 404);
        }
    }
}
