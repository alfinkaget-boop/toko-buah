<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $order = DB::transaction(function () use ($cart, $data) {
            $total = 0;
            $order = Order::create($data + ['total' => 0, 'status' => 'Menunggu konfirmasi']);

            foreach ($cart as $productId => $item) {
                $product = Product::whereKey($productId)->lockForUpdate()->first();
                if (!$product || !$product->is_active || $product->stock < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'cart' => 'Stok ' . ($item['name'] ?? 'produk') . ' tidak mencukupi. Silakan periksa keranjang.',
                    ]);
                }

                $subtotal = (float) $product->price * (int) $item['quantity'];
                $total += $subtotal;

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            $order->update(['total' => $total]);
            return $order;
        });

        session()->forget('cart');
        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        $order->load('items');
        return view('checkout.success', compact('order'));
    }

    public function konfirmasiPesanan(Order $order)
{
    $order->update(['status' => 'Dikonfirmasi']);
    return back()->with('success', 'Pesanan berhasil dikonfirmasi, siap dikirim!');
}


    public function batalkanPesanan(Order $order)
{
    $order->update(['status' => 'Dibatalkan']);
    return back()->with('success', 'Pesanan dibatalkan.');
}

   public function myOrders() // s
{
    $orders = \App\Models\Order::with('items')->latest()->get(); // s
    return view('order.my', compact('orders')); // folder tanpa s, tapi compact pakai s
}
}
