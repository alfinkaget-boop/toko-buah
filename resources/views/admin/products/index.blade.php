<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        a, button {
            padding: 8px 12px;
            background: #16a34a;
            color: white;
            text-decoration: none;
            border: 0;
            cursor: pointer;
        }

        .delete {
            background: #dc2626;
        }
    </style>
</head>

<body>

<h1>Dashboard Admin Toko Buah</h1>

<div class="box">
    <h3>Total Produk Buah</h3>
    <h1>{{ $totalProducts }}</h1>
</div>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.products.create') }}">+ Tambah Buah</a>

<a href="{{ route('admin.pesanan.index') }}" style="margin-left:10px">Lihat Pesanan</a>

<br><br>

<table>
    <tr>
        <th>Foto</th>
        <th>Nama Buah</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <td>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                width="65">
            @else
                Belum ada foto
            @endif
        </td>

        <td>{{ $product->name }}</td>

        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>

        <td>{{ $product->stock }}</td>

        <td>
            <a href="{{ route('admin.products.edit', $product->id) }}">
                Edit
            </a>

            <form action="{{ route('admin.products.destroy', $product->id) }}"
            method="POST" style="display:inline"
            onsubmit="return confirm('Yakin ingin menghapus buah ini?')">

                @csrf
                @method('DELETE')

                <button class="delete">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<br>

{{ $products->links() }}

<br>

<form action="{{ route('admin.logout') }}" method="POST">
    @csrf
    <button style="background:#dc2626">Logout</button>
</form>

</body>
</html>