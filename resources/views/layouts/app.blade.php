<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Toko Buah')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--green:#16834a;--dark:#173b2a;--soft:#f3f8f2}
        *{font-family:Poppins,sans-serif}body{background:#fbfdfb;color:#24352b}
        .navbar{background:white;box-shadow:0 3px 18px #173b2a10}
        .brand{font-weight:800;color:var(--green)!important;font-size:1.45rem}
        .btn-green{background:var(--green);color:white;border:0}.btn-green:hover{background:#11683a;color:white}
        .hero{background:linear-gradient(110deg,#e5f5e8,#f8fbeb);border-radius:26px;padding:54px 42px}
        .hero h1{font-weight:800;color:var(--dark);font-size:clamp(2rem,5vw,3.4rem)}
        .section-title{font-weight:700;color:var(--dark)}
        .fruit-card{border:0;border-radius:18px;overflow:hidden;box-shadow:0 8px 26px #193d2510;height:100%;transition:.2s}
        .fruit-card:hover{transform:translateY(-4px)}
        .fruit-card img{height:190px;object-fit:cover;background:var(--soft)}
        .price{color:var(--green);font-weight:700}.muted{color:#718078}
        footer{background:#173b2a;color:#e8f5eb;margin-top:70px}
        .form-control,.form-select{padding:12px;border-radius:10px}
        .rounded-box{background:white;border-radius:18px;box-shadow:0 8px 26px #193d2510;padding:25px}
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container py-2">
    <a class="navbar-brand brand" href="{{ route('store.index') }}">Toko Buah Alfin</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
        <li class="nav-item"><a class="nav-link" href="{{ route('store.index') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">🛒 Keranjang</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('pesanan.saya') }}">Pesanan Saya</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}">Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="container py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    @yield('content')
</main>
<footer class="py-4"><div class="container text-center"><strong>Toko Buah Alfin</strong><div class="small mt-2">Buah segar setiap hari, pilihan sehat keluarga.</div></div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
