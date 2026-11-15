SEGARMART - TEMPLATE TOKO BUAH LARAVEL 13

Fitur:
- Beranda dan katalog buah
- Pencarian produk
- Detail produk
- Keranjang belanja berbasis session
- Checkout dengan data pembeli
- Penyimpanan pesanan dan detail pesanan
- Stok otomatis berkurang setelah pesanan berhasil
- Pembayaran COD (belum terhubung payment gateway)
- Data contoh melalui seeder

CARA MEMASANG:
1. Buat project Laravel 13:
   composer create-project laravel/laravel segarmart
2. Ekstrak ZIP ini.
3. Salin seluruh isi folder hasil ekstrak ke folder project Laravel (gabungkan folder app, database, resources, routes).
4. Buat database MySQL bernama segarmart.
5. Atur .env:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=segarmart
   DB_USERNAME=root
   DB_PASSWORD=
   Sesuaikan username/password database Anda.
6. Jalankan:
   php artisan key:generate
   php artisan migrate
   php artisan db:seed --class=ProductSeeder
   php artisan serve
7. Buka http://127.0.0.1:8000

CATATAN:
- Ini adalah template toko sisi pelanggan; belum ada halaman admin untuk mengelola produk.
- Ubah data contoh di database/seeders/ProductSeeder.php.
- URL gambar contoh memakai Unsplash. Ganti URL gambar yang tidak tampil dengan URL gambar valid atau simpan gambar sendiri di public/images.
- Checkout hanya menyimpan pesanan dengan status menunggu konfirmasi. Belum ada pembayaran online, ongkir otomatis, login pelanggan, atau dashboard admin.
- Untuk produksi, aktifkan HTTPS, validasi operasional, backup database, dan pengelolaan admin yang aman.
