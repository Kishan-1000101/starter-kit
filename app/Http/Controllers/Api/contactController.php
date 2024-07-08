<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        if ($contacts->count() > 0) {
            return response()->json([
                'status' => 200,
                'contacts' => $contacts
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
            'company_id' => 'nullable|integer|exists:companies,id',
            'company_position' => 'nullable|string|max:255',
            'contact_type_id' => 'nullable|integer|exists:contact_types,id',
            'title' => 'nullable|string|max:10',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'fixed_phone' => 'nullable|string|max:50',
            'mobile_phone' => 'nullable|string|max:50',
            'address_id' => 'nullable|integer|exists:addresses,id',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new contact instance
        $contact = Contact::create($request->all());

        // Return success response with the created contact data
        return response()->json([
            'status' => 201,
            'message' => 'Contact created successfully',
            'contact' => $contact
        ], 201);
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            return response()->json([
                'status' => 200,
                'contact' => $contact
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such contact found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json([
                'status' => 404,
                'message' => 'Contact not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tier_id' => 'nullable|integer|exists:tiers,id',
            'company_id' => 'nullable|integer|exists:companies,id',
            'company_position' => 'nullable|string|max:255',
            'contact_type_id' => 'nullable|integer|exists:contact_types,id',
            'title' => 'nullable|string|max:10',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'fixed_phone' => 'nullable|string|max:50',
            'mobile_phone' => 'nullable|string|max:50',
            'address_id' => 'nullable|integer|exists:addresses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $contact->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Contact updated successfully',
            'contact' => $contact
        ], 200);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Contact deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such contact found'
            ], 404);
        }
    }
}
