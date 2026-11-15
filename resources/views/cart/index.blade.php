@extends('layouts.app')
@section('title','Keranjang Belanja')
@section('content')
<h2 class="section-title mb-4">Keranjang Belanja</h2>
@if(empty($cart))
  <div class="rounded-box text-center py-5"><div style="font-size:65px">🛒</div><h5>Keranjang masih kosong</h5><a href="{{ route('store.index') }}" class="btn btn-green mt-2">Mulai Belanja</a></div>
@else
<div class="rounded-box">
  @foreach($cart as $id => $item)
  <div class="row align-items-center border-bottom py-3 g-3">
    <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://via.placeholder.com/150' }}" style="width:100%">
    <div class="col-9 col-md-4"><strong>{{ $item['name'] }}</strong><div class="price">Rp {{ number_format($item['price'],0,',','.') }}</div></div>
    <div class="col-7 col-md-4">
      <form action="{{ route('cart.update',$id) }}" method="POST" class="d-flex gap-2">@csrf @method('PATCH')
        <input type="number" name="quantity" min="1" value="{{ $item['quantity'] }}" class="form-control" style="max-width:90px">
        <button class="btn btn-outline-success">Ubah</button>
      </form>
    </div>
    <div class="col-5 col-md-2 text-end">
      <form action="{{ route('cart.remove',$id) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Hapus</button></form>
      <strong class="d-block mt-2">Rp {{ number_format($item['price']*$item['quantity'],0,',','.') }}</strong>
    </div>
  </div>
  @endforeach
  <div class="text-end mt-4">
    <h4>Total: <span class="price">Rp {{ number_format($total,0,',','.') }}</span></h4>
    <a href="{{ route('store.index') }}" class="btn btn-outline-danger btn-lg mt-2">tambah buah</a>
  <a href="{{ route('checkout.index') }}" class="btn btn-green btn-lg mt-2">Lanjut Checkout</a>
  
</div>

</div>
@endif
@endsection
