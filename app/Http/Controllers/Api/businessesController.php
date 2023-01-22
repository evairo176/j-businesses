<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Businesses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class businessesController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'alias' => 'required',
            'name' => 'required',
            'image_url' => 'required',
            'is_closed' => 'required|boolean',
            'review_count' => 'required|numeric',
            'categories' => 'required',
            'rating' => 'required|numeric',
            'coordinates' => 'required',
            'transactions' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'phone' => 'required',
            'display_phone' => 'required',
            'distance' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->messages()
            ], 200);
        }

        $data = [
            'alias' => Str::slug($request->alias),
            'name' => $request->name,
            'image_url' => $request->image_url,
            'url' => $request->url,
            'is_closed' => false,
            'review_count' => $request->review_count,
            'categories' => json_encode($request->categories),
            'rating' => $request->rating,
            'coordinates' => json_encode($request->coordinates),
            'transactions' => json_encode($request->transactions),
            'price' => $request->price,
            'location' => json_encode($request->location),
            'phone' => $request->phone,
            'display_phone' => $request->display_phone,
            'distance' => $request->distance,
        ];

        $businesses = Businesses::create($data);

        return response()->json([
            "success" => true,
            "message" => "created successfully",
            "businesses" => $businesses
        ], 200);
    }

    public function update(Request $request)
    {
        $businesses = Businesses::find($request->id);

        $data = [
            'alias' => Str::slug($request->alias),
            'name' => $request->name,
            'image_url' => $request->image_url,
            'url' => $request->url,
            'is_closed' => $request->is_closed,
            'review_count' => $request->review_count,
            'categories' => json_encode($request->categories),
            'rating' => $request->rating,
            'coordinates' => json_encode($request->coordinates),
            'transactions' => json_encode($request->transactions),
            'price' => $request->price,
            'location' => json_encode($request->location),
            'phone' => $request->phone,
            'display_phone' => $request->display_phone,
            'distance' => $request->distance,
        ];

        $businesses->update($data);

        return response()->json([
            "success" => true,
            "message" => "updated successfully",
            "businesses" => $businesses
        ], 200);
    }

    public function delete(Request $request)
    {
        $businesses = Businesses::find($request->id);

        $businesses->delete();

        return response()->json([
            "success" => true,
            "message" => "deleted successfully",
            "businesses" => $businesses
        ], 200);
    }
    public function fetchDataByParams($field = null, $keyword = null,  $sortBy = null, $limit = null,)
    {
        $dataSort = [
            'alias',
            'name',
            'image_url',
            'url',
            'is_closed',
            'review_count',
            'categories',
            'rating',
            'coordinates',
            'transactions',
            'price',
            'location',
            'phone',
            'display_phone',
            'distance',
        ];

        if (!in_array($sortBy, $dataSort)) {
            return response()->json([
                "success" => false,
                "message" => "the existing data input does not meet the existing data requirements",
                "example" =>  $dataSort,
            ], 404);
        }

        $businesses = Businesses::where($field, 'like', '%' . $keyword . '%')
            ->orderBy($sortBy)
            ->paginate($limit);

        return response()->json([
            "success" => true,
            "message" => "read data by params successfully",
            "businesses" => $businesses
        ], 200);
    }
    public function fetchAllData()
    {

        $businesses = Businesses::all();

        return response()->json([
            "success" => true,
            "message" => "read all successfully",
            "businesses" => $businesses
        ], 200);
    }
}
