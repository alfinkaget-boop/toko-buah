<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


   public function index()
{
    $products = Product::latest()->paginate();
    $totalProducts = Product::count();
    return view('admin.products.index', compact('products', 'totalProducts'));
}

    public function create()
    {
        return view('admin.products.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'category' => 'nullable',
        'description' => 'nullable',
        'image' => 'nullable|image|max:2048',
    ]);

   $data = $request->only(['name','price','stock','category','description']);

   // Bikin slug otomatis dari nama, contoh: Apel Fuji -> apel-fuji
$data['slug'] = \Illuminate\Support\Str::slug($request->name);

// Kalau slug-nya udah ada yang pake, tambahin angka biar unik
$count = 1;
$originalSlug = $data['slug'];
while (Product::where('slug', $data['slug'])->exists()) {
    $data['slug'] = $originalSlug . '-' . $count;
    $count++;
}

    // Kalau ada foto, simpan fotonya
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($data);

    return redirect()->route('admin.products.index')->with('success', 'Buah berhasil ditambah!');
}

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    $data = $request->except('image');

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);
    return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}