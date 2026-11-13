<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return CartResource::collection(Cart::with(['user', 'product'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::create($validated);
        return new CartResource($cart);
    }

    public function show($id)
    {
        $cart = Cart::with(['user', 'product'])->findOrFail($id);
        return new CartResource($cart);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update($validated);
        return new CartResource($cart);
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json(['message' => 'Cart item deleted successfully']);
    }
}