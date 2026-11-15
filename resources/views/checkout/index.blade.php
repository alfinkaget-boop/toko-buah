@extends('layouts.app')
@section('title','Checkout')
@section('content')
<h2 class="section-title mb-4">Checkout Pesanan</h2>
<div class="row g-4">
  <div class="col-lg-7">
    <form action="{{ route('checkout.store') }}" method="POST" class="rounded-box">
      @csrf
      <h5 class="mb-3">Data Pembeli</h5>
      <label class="form-label">Nama lengkap</label><input name="customer_name" class="form-control mb-3" value="{{ old('customer_name') }}" required>
      <label class="form-label">Nomor WhatsApp/HP</label><input name="phone" class="form-control mb-3" value="{{ old('phone') }}" required>
      <label class="form-label">Alamat pengiriman</label><textarea name="address" class="form-control mb-3" rows="3" required>{{ old('address') }}</textarea>
      <label class="form-label">Catatan (opsional)</label><textarea name="notes" class="form-control mb-3" rows="2">{{ old('notes') }}</textarea>
      <div class="alert alert-info">Metode pembayaran: Bayar di tempat (COD) — konfirmasi pesanan dilakukan oleh penjual.</div>
      <button class="btn btn-green btn-lg w-100">Buat Pesanan</button>
    </form>
  </div>
  <div class="col-lg-5"><div class="rounded-box"><h5>Ringkasan</h5>
    @foreach($cart as $item)<div class="d-flex justify-content-between py-2 border-bottom"><span>{{ $item['name'] }} × {{ $item['quantity'] }}</span><strong>Rp {{ number_format($item['price']*$item['quantity'],0,',','.') }}</strong></div>@endforeach
    <h5 class="text-end mt-3">Total Rp {{ number_format($total,0,',','.') }}</h5>
  </div></div>
</div>
@endsection
