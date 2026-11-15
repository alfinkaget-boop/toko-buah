@extends('layouts.app')
@section('title',$product->name.' | SegarMart')
@section('content')
<div class="row g-5 align-items-center">
  <div class="col-md-6"><img class="w-100 rounded-4" style="max-height:440px;object-fit:cover" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/600x400?text=Buah' }}"></div>
  <div class="col-md-6">
    <a href="{{ route('store.index') }}" class="text-success text-decoration-none">← Kembali ke produk</a>
    <h1 class="section-title mt-3">{{ $product->name }}</h1>
    <h3 class="price my-3">Rp {{ number_format($product->price,0,',','.') }}</h3>
    <p class="muted">{{ $product->description }}</p>
    <p>Stok tersedia: <strong>{{ $product->stock }}</strong></p>
    @if($product->stock > 0)
    <form action="{{ route('cart.add',$product) }}" method="POST" class="d-flex gap-2 align-items-end">
      @csrf
      <div><label class="form-label">Jumlah</label><input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" style="width:100px"></div>
      <button class="btn btn-green btn-lg">+ Keranjang</button>
    </form>
    @else <span class="badge text-bg-secondary">Stok habis</span> @endif
  </div>
</div>
@endsection
