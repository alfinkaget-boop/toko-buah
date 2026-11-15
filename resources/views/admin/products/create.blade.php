<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buah</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 50px 20px;
            margin: 0;
        }
        .card {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            color: #16a34a;
            margin-top: 0;
            margin-bottom: 25px;
        }
        label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            color: #334155;
            margin-bottom: 6px;
            margin-top: 15px;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }
        input:focus, textarea:focus {
            border-color: #16a34a;
        }
        textarea {
            min-height: 80px;
            resize: vertical;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
        }
        .btn-simpan {
            width: 100%;
            padding: 12px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 25px;
        }
        .btn-simpan:hover {
            background: #15803d;
        }
        .btn-kembali {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-kembali:hover {
            color: #16a34a;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>🍎 Tambah Buah Baru</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nama Buah</label>
        <input type="text" name="name" placeholder="Contoh: Apel Fuji" required>

        <label>Harga</label>
        <input type="number" name="price" placeholder="Contoh: 15000" required min="0">

        <label>Stok</label>
        <input type="number" name="stock" placeholder="Contoh: 50" required min="0">

        <label>Kategori</label>
        <input type="text" name="category" placeholder="Contoh: Buah Impor / Lokal">

        <label>Deskripsi</label>
        <textarea name="description" placeholder="Tulis deskripsi buahnya..."></textarea>

        <label>Foto Buah</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit" class="btn-simpan">Simpan Buah</button>
    </form>

    <a href="{{ route('admin.dashboard') }}" class="btn-kembali">← Kembali ke Dashboard</a>
</div>

</body>
</html>