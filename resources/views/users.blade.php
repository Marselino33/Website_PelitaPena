<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Daftar Users</title>
</head>
<body>
  <h1>Users dari Go‑Backend</h1>
  <ul>
    @forelse ($users as $user)
      <li>{{ $user['id'] }}: {{ $user['name'] }}</li>
    @empty
      <li>Tidak ada data.</li>
    @endforelse
  </ul>
</body>
</html>
