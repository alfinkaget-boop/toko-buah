<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil pesanan terbaru duluan, sekalian sama isi buahnya
        $orders = Order::with('items')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
}