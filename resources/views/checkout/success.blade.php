@extends('layouts.app')
@section('title','Pesanan Berhasil')
@section('content')
<div class="rounded-box text-center py-5">
  <div style="font-size:70px">✅</div><h2 class="section-title">Pesanan berhasil dibuat!</h2>
  <p class="muted">Nomor pesanan: <strong>#{{ $order->id }}</strong></p>
  <p>Terima kasih, {{ $order->customer_name }}. Penjual akan menghubungi {{ $order->phone }} untuk konfirmasi.</p>
  <div class="text-start mx-auto mt-4" style="max-width:600px">
    @foreach($order->items as $item)<div class="d-flex justify-content-between border-bottom py-2"><span>{{ $item->product_name }} × {{ $item->quantity }}</span><strong>Rp {{ number_format($item->subtotal,0,',','.') }}</strong></div>@endforeach
    <h5 class="text-end mt-3">Total: Rp {{ number_format($order->total,0,',','.') }}</h5>
    <p>Status: <span class="badge text-bg-warning">{{ $order->status }}</span></p>
  </div>
  {{-- KONFIRMASI PESANAN COD --}}
@if($order->status == 'Menunggu konfirmasi')
    <div class="card p-4 mt-4">
        <h5>Metode Pembayaran: COD (Bayar di Tempat)</h5>
        <p>Pesananmu sedang dicek admin. Bayar Rp {{ number_format($order->total, 0, ',', '.') }} pas kurir sampai ya.</p>


        <form action="{{ route('pesanan.batal', $order->id) }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger w-100">Batalkan Pesanan</button>
        </form>
    </div>
@elseif($order->status == 'Dikonfirmasi')
    <div class="alert alert-success mt-4">
        ✅ Pesanan sudah dikonfirmasi! Kurir lagi siapin buahnya, siapin uang pas Rp {{ number_format($order->total, 0, ',', '.') }} ya.
    </div>
@elseif($order->status == 'Dibatalkan')
    <div class="alert alert-danger mt-4">
        Pesanan dibatalkan.
    </div>
@endif
  <a href="{{ route('store.index') }}" class="btn btn-green mt-3">Kembali Belanja</a>
</div>
@endsection
