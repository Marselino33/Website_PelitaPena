<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Laporan Masyarakat</title>
  <style>
    body {
      font-family: "Times New Roman", serif;
      font-size: 12pt;
      margin: 40px;
      color: #000;
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      position: relative;
    }
    .header img {
      position: absolute;
      top: 0;
      left: 0;
      width: 70px;
    }
    .header .institution {
      font-size: 16pt;
      font-weight: bold;
      line-height: 1.2;
    }
    .header .sub {
      font-size: 12pt;
      margin-top: 4px;
    }
    .title {
      text-align: center;
      margin: 30px 0 10px;
      font-size: 14pt;
      text-decoration: underline;
    }
    .meta {
      text-align: center;
      font-size: 10pt;
      margin-bottom: 20px;
      color: #555;
    }
    .report {
      margin-bottom: 20px;
    }
    .report-number {
      font-weight: bold;
      margin-bottom: 6px;
    }
    .report-content p {
      margin: 2px 0;
      text-indent: 20px;
    }
    .footer {
      position: fixed;
      bottom: 30px;
      left: 40px;
      right: 40px;
      text-align: center;
      font-size: 10pt;
      color: #666;
      border-top: 1px solid #ccc;
      padding-top: 4px;
    }
  </style>
</head>
<body>

  <div class="header">
    <img src="{{ public_path('assets/img/logo/new_logo.svg') }}" alt="Logo">
    <div class="institution">PELITA PENA</div>
    <div class="sub">DPMDPPA<br>Jl. Setia Budi No.154, Lumpo, Kec. Iv Jurai, Kabupaten Pesisir Selatan, Sumatera Barat 25651</div>
  </div>

  <div class="title">LAPORAN MASYARAKAT</div>
  <div class="meta">Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</div>

  @foreach($laporans as $index => $laporan)
    @php
      $created = \Carbon\Carbon::parse($laporan['created_at']);
    @endphp

    <div class="report">
      <div class="report-number">Laporan {{ $index + 1 }}.</div>
      <div class="report-content">
        <p><strong>No. Registrasi:</strong> {{ $laporan['no_registrasi'] }}</p>
        <p><strong>Tanggal Pelaporan:</strong> {{ $created->format('d M Y') }}</p>
        <p><strong>Jam Pelaporan:</strong> {{ $created->format('H:i') }} WIB</p>
        <p><strong>Status:</strong> {{ $laporan['status'] }}</p>
      </div>
    </div>
  @endforeach

  <div class="footer">
    Halaman {PAGE_NUM} / {PAGE_COUNT}
  </div>

</body>
</html>
