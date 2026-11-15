<!DOCTYPE html>
<html>
<head>
    <title>Edit Buah</title>
</head>
<body style="font-family:Arial;padding:30px">

<h2>Edit Data Buah</h2>

<form action="{{ route('admin.products.update', $product->id) }}"
method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <p>Nama Buah</p>
    <input type="text" name="name"
    value="{{ $product->name }}" required>

    <p>Harga</p>
    <input type="number" name="price"
    value="{{ $product->price }}" required min="0">

    <p>Stok</p>
    <input type="number" name="stock"
    value="{{ $product->stock }}" required min="0">

    <p>Kategori</p>
    <input type="text" name="category"
    value="{{ $product->category }}">

    <p>Deskripsi</p>
    <textarea name="description">{{ $product->description }}</textarea>

    <p>Foto Sekarang</p>

    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}"
                width="65">
    @endif

    <p>Ganti Foto</p>
    <input type="file" name="image" accept="image/*">

    <br><br>

    <button type="submit">Update Buah</button>

</form>

<br>

<a href="{{ route('admin.dashboard') }}">Kembali</a>

</body>
</html>