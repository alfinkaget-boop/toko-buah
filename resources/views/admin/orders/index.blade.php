@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Daftar Pesanan Masuk</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pembeli</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Isi Pesanan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->phone ?? '-' }}</td>
                <td>{{ $order->address ?? '-' }}</td>
               <td style="white-space: nowrap;">
    @foreach($order->items as $item)
        {{ $item->product_name ?? 'Buah' }} x {{ $item->qty ?? $item->quantity ?? 1 }}<br>
    @endforeach
</td>
                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                <td><span class="badge text-bg-warning">{{ $order->status }}</span></td>
                <td>
                    @if($order->status == 'Menunggu konfirmasi')
                    <form action="{{ route('admin.pesanan.konfirmasi', $order->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-success btn-sm">Konfirmasi</button>
                    </form>
                    @else
                        ✅ Sudah Dikonfirmasi
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada pesanan masuk</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div> 
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary mt-3">← Kembali ke Produk</a>
</div>
@endsection