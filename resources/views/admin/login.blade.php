<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body style="font-family:Arial;background:#f1f5f9;padding:50px">

<div style="max-width:350px;margin:auto;background:white;padding:30px;border-radius:12px">

    <h2>Login Admin</h2>

    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('admin.login.process') }}" method="POST">
        @csrf

        <input type="text" name="username" placeholder=" username"
        required style="width:100%;padding:12px;margin-bottom:15px">

        <input type="password" name="password" placeholder="Password"
        required style="width:100%;padding:12px;margin-bottom:15px">

        <button type="submit"
        style="width:100%;padding:12px;background:#16a34a;color:white;border:0">
            Login
        </button>
    </form>
<button onclick="window.location.href='{{ route('store.index') }}'"
    style="width:100%;padding:12px;background:#6b7280;color:white;border:0;margin-top:10px">
    Kembali ke Toko
</div>

</body>
</html>