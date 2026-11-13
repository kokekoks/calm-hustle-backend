<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::with('category')->get());
    }

    public function store(Request $request)
    {
        
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|string',
        ]);

        $product = Product::create($validated);
        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return new ProductResource($product);
    }

    public function update(Request $request, $id)
    {
     
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'sometimes|required|exists:categories,category_id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
            'image' => 'nullable|string',
        ]);

        $product->update($validated);
        return new ProductResource($product);
    }

    public function destroy(Request $request, $id)
    {
     
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}