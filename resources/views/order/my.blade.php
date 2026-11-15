@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Pesanan Saya</h3>
    <p class="text-muted">Ini daftar semua pesanan yang sudah kamu buat.</p>

    @forelse($orders as $order)
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <b>Pesanan #{{ $order->id }} - {{ $order->customer_name }}</b>
            <span class="badge text-bg-warning">{{ $order->status }}</span>
        </div>
        <div class="card-body">
            @foreach($order->items as $item)
                {{ $item->product_name ?? 'Buah' }} x {{ $item->qty ?? $item->quantity ?? 1 }} - Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}<br>
            @endforeach
            <hr>
            <b>Total: Rp {{ number_format($order->total, 0, ',', '.') }}</b><br>
            <small>Alamat: {{ $order->address }} | HP: {{ $order->phone }}</small>
        </div>
    </div>
    @empty
    <p>Belum ada pesanan. <a href="/">Mulai Belanja</a></p>
    @endforelse
</div>
@endsection