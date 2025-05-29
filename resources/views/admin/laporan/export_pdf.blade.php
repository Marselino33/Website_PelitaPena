<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: "Times New Roman", serif; font-size:12pt; margin:30px; }
    .header { text-align:center; border-bottom:2px solid #000; padding-bottom:10px; margin-bottom:20px; }
    .header img { position:absolute; top:10px; left:30px; width:70px; }
    .institution { font-size:16pt; font-weight:bold; }
    .sub { font-size:12pt; margin-top:4px; }
    .title { text-align:center; font-size:14pt; text-decoration:underline; margin:20px 0; }
    .meta { text-align:right; font-size:10pt; color:#555; margin-bottom:15px; }
    .report { margin-bottom:30px; }
    .report-number { font-size:12pt; font-weight:bold; margin-bottom:8px; }
    .report-content p { margin:4px 0; }
    .section-title { font-size:12pt; font-weight:bold; margin-top:12px; text-decoration:underline; }
    .detail-item { margin:2px 0 2px 20px; }
    .footer { position:fixed; bottom:5mm; width:100%; text-align:center; font-size:10pt; color:#666; border-top:1px solid #ccc; padding-top:3px; }
  </style>
</head>
<body>
  <div class="header">
    <img src="{{ public_path('assets/img/logo/new_logo.svg') }}" alt="Logo">
    <div class="institution">SIGAP</div>
    <div class="sub">DPMDPPA • Jl. Setia Budi No.154, Lumpo, Iv Jurai, Pesisir Selatan, Sumbar 25651</div>
  </div>

  <div class="title">LAPORAN MASYARAKAT</div>
  <div class="meta">Dicetak: {{ now()->format('d M Y H:i') }} WIB</div>

  @foreach($laporans as $i => $laporan)
    @php $c = \Carbon\Carbon::parse($laporan->created_at); @endphp
    <div class="report">
      <div class="report-number">
        {{ $i+1 }}. {{ $laporan->no_registrasi }}
      </div>
      <div class="report-content">
        <p><strong>Pelapor:</strong> {{ $laporan->nama }}</p>
        <p><strong>Judul:</strong> {{ $laporan->judul }}</p>
        <p><strong>Tanggal:</strong> {{ $c->format('d M Y') }} <strong>Jam:</strong> {{ $c->format('H:i') }} WIB</p>
        <p><strong>Status:</strong> {{ $laporan->status }}</p>
      </div>

      <div class="section-title">Data Korban</div>
      @forelse($laporan->korban as $korban)
        <div class="detail-item"><strong>NIK:</strong> {{ $korban->nik_korban }}</div>
        <div class="detail-item"><strong>Nama:</strong> {{ $korban->nama }}</div>
        <div class="detail-item"><strong>Usia:</strong> {{ $korban->usia }}</div>
        <div class="detail-item"><strong>Alamat:</strong> {{ $korban->alamat_korban }} {{ $korban->alamat_detail }}</div>
        <div class="detail-item"><strong>JK:</strong> {{ $korban->jenis_kelamin }}</div>
        <div class="detail-item"><strong>Agama:</strong> {{ $korban->agama }}</div>
        <div class="detail-item"><strong>Telp:</strong> {{ $korban->no_telepon }}</div>
        <div class="detail-item"><strong>Pendidikan:</strong> {{ $korban->pendidikan }}</div>
        <div class="detail-item"><strong>Pekerjaan:</strong> {{ $korban->pekerjaan }}</div>
        <div class="detail-item"><strong>Status Nikah:</strong> {{ $korban->status_perkawinan }}</div>
        <div class="detail-item"><strong>Kewarganegaraan:</strong> {{ $korban->kebangsaan }}</div>
        <div class="detail-item"><strong>Hubungan:</strong> {{ $korban->hubungan_dengan_korban }}</div>
        <div class="detail-item"><strong>Keterangan:</strong> {{ $korban->keterangan_lainnya }}</div>
      @empty
        <div class="detail-item">— Tidak ada data korban —</div>
      @endforelse

      <div class="section-title">Data Pelaku</div>
      @forelse($laporan->pelaku as $pelaku)
        <div class="detail-item"><strong>NIK:</strong> {{ $pelaku->nik_pelaku }}</div>
        <div class="detail-item"><strong>Nama:</strong> {{ $pelaku->nama }}</div>
        <div class="detail-item"><strong>Usia:</strong> {{ $pelaku->usia }}</div>
        <div class="detail-item"><strong>Alamat:</strong> {{ $pelaku->alamat_pelaku }} {{ $pelaku->alamat_detail }}</div>
        <div class="detail-item"><strong>JK:</strong> {{ $pelaku->jenis_kelamin }}</div>
        <div class="detail-item"><strong>Agama:</strong> {{ $pelaku->agama }}</div>
        <div class="detail-item"><strong>Telp:</strong> {{ $pelaku->no_telepon }}</div>
        <div class="detail-item"><strong>Pendidikan:</strong> {{ $pelaku->pendidikan }}</div>
        <div class="detail-item"><strong>Pekerjaan:</strong> {{ $pelaku->pekerjaan }}</div>
        <div class="detail-item"><strong>Status Nikah:</strong> {{ $pelaku->status_perkawinan }}</div>
        <div class="detail-item"><strong>Kewarganegaraan:</strong> {{ $pelaku->kebangsaan }}</div>
        <div class="detail-item"><strong>Hubungan:</strong> {{ $pelaku->hubungan_dengan_korban }}</div>
        <div class="detail-item"><strong>Keterangan:</strong> {{ $pelaku->keterangan_lainnya }}</div>
      @empty
        <div class="detail-item">— Tidak ada data pelaku —</div>
      @endforelse
    </div>
  @endforeach

  <div class="footer">
    Halaman {PAGE_NUM} / {PAGE_COUNT}
  </div>
</body>
</html>
