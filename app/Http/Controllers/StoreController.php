<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('is_active', true)
            ->when($request->filled('q'), fn ($query) =>
                $query->where('name', 'like', '%' . $request->q . '%'))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('store.index', compact('products'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);
        return view('store.show', compact('product'));
    }
}
