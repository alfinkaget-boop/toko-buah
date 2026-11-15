@extends('layouts.app')
@section('title','Toko Buah Alfin')
@section('content')
<section class="hero mb-5">
  <div class="row align-items-center">
    <div class="col-lg-7">
      <span class="badge text-bg-success mb-3">Segar • Sehat • Berkualitas</span>
      <h1>Kesegaran buah,<br>langsung ke rumahmu.</h1>
      <p class="lead muted mt-3">Pilih buah favoritmu dengan mudah. Buah pilihan untuk hidup lebih sehat.</p>
      <a href="#produk" class="btn btn-green btn-lg mt-2 px-4">Belanja Sekarang</a>
    </div>
    <div class="col-lg-5 text-center mt-4 mt-lg-0"><div style="font-size:150px">🍉🍊🍇</div></div>
  </div>
</section>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4" id="produk">
  <div><h2 class="section-title mb-1">Buah Pilihan</h2><div class="muted">Temukan buah segar favoritmu</div></div>
  <form class="d-flex gap-2" method="GET">
    <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Cari buah...">
    <button class="btn btn-green px-3">Cari</button>
  </form>
</div>
<div class="row g-4">
@forelse($products as $product)
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card fruit-card">
   <a href="{{ route('store.show',$product->slug) }}"><img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/600x400?text=Buah' }}" style="width:100%;height:200px;object-fit:cover"></a>
      <div class="card-body">
        <h6 class="fw-semibold">{{ $product->name }}</h6>
        <div class="price mb-1">Rp {{ number_format($product->price,0,',','.') }}</div>
        <small class="muted">Stok: {{ $product->stock }}</small>
        <a href="{{ route('store.show',$product->slug) }}" class="btn btn-green w-100 mt-3">Lihat Produk</a>
      </div>
    </div>
  </div>
@empty
  <div class="col-12"><div class="alert alert-info">Produk tidak ditemukan.</div></div>
@endforelse
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
