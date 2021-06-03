<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        $response = [
            'success' => true,
            'data'    => $products,
            'message' => 'Products retrieved',
        ];

        return response()->json($response, 200);
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name'      => 'required',
            'price'     => 'required'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => 'Validation Error',
            ];

            return response()->json($response, 404);

        }

        $product = Product::create($input);

        $response = [
            'success' => true,
            'data'    => $product,
            'message' => 'Product created',
        ];

        return response()->json($response, 200);

    }
}
