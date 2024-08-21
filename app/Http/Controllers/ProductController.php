<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:1',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'errors'       => $validator->errors(),
                    'success'      => false,
                    'status'       => 200,
                ]);
            }


            // Create a new product
            $product = Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
            ]);

            // Return a success response
            return response()->json([
                'status'  => 200,
                'success' => true,
                'message' => 'Product created successfully',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
                /**
                 * Display the specified resource.
                 */


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Product::findOrFail($id);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    try {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'errors'  => $validator->errors(),
                'success' => false,
                'status'  => 422,  // Unprocessable Entity status code for validation errors
            ]);
        }

        // Fetch the product by ID
        $product = Product::findOrFail($id);

        // Update the product
        $product->update([
            'name'     => $request->input('name'),
            'price'    => $request->input('price'),
            'quantity' => $request->input('quantity'),
        ]);

        // Return a success response
        return response()->json([
            'status'  => 200,
            'success' => true,
            'message' => 'Product updated successfully',
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status'  => 500,
            'success' => false,
            'message' => $e->getMessage(),
        ]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Fetch the product by ID
            $product = Product::findOrFail($id);

            // Delete the product
            $product->delete();

            return response()->json([
                'status'  => 200,
                'success' => true,
                'message' => 'Product deleted successfully',
                'data'    => $product  // Optionally, you can remove 'data' if not needed
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
