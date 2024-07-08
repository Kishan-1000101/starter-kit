<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class countryController extends Controller
{
     public function index()
    {
        $countries = Country::all();
        if ($countries->count() > 0) {
            return response()->json([
                'status' => 200,
                'countries' => $countries
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
        $validator = Validator::make($request->all(), [
            'code' => 'required|integer|unique:countries,code',
            'alpha2' => 'required|string|size:2|unique:countries,alpha2',
            'alpha3' => 'required|string|size:3|unique:countries,alpha3',
            'name' => 'required|string|max:255|unique:countries,name',
            'name_fr_FR' => 'required|string|max:255|unique:countries,name_fr_FR',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $country = Country::create($request->all());

            if ($country) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Country created successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $country = Country::find($id);
        if ($country) {
            return response()->json([
                'status' => 200,
                'country' => $country
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such country found'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|integer|unique:countries,code,' . $id,
            'alpha2' => 'required|string|size:2|unique:countries,alpha2,' . $id,
            'alpha3' => 'required|string|size:3|unique:countries,alpha3,' . $id,
            'name' => 'required|string|max:255|unique:countries,name,' . $id,
            'name_fr_FR' => 'required|string|max:255|unique:countries,name_fr_FR,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $country = Country::find($id);

        if (!$country) {
            return response()->json([
                'status' => 404,
                'message' => 'No such country found'
            ], 404);
        }

        $country->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Country updated successfully'
        ], 200);
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        if ($country) {
            $country->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Country deleted successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such country found'
            ], 404);
        }
    }
}
