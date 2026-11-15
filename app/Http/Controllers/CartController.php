<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1']]);
        abort_unless($product->is_active, 404);

        $cart = session('cart', []);
        $current = $cart[$product->id]['quantity'] ?? 0;
        $quantity = $current + $data['quantity'];

        if ($quantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$product->id] = [
            'name' => $product->name,
            'price' => (float) $product->price,
            'image' => $product->image,
            'quantity' => $quantity,
        ];

        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Buah berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1']]);
        $cart = session('cart', []);

        if (!isset($cart[$product->id])) {
            return back();
        }
        if ($data['quantity'] > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$product->id]['quantity'] = $data['quantity'];
        session(['cart' => $cart]);
        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
