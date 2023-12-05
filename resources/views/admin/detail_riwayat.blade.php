@extends('admin.layout')

@section('content')
<div class="container mt-4">
    @if(count($riwayatSewa) > 0)
    <h1 class="text-center mb-2">RIWAYAT PENYEWAAN MOBIL</h1>
        <div class="section1">
            <h2>Data Mobil Mobil</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Kembali</th>
                            <th>Nomor Plat</th>
                            <th>Merek</th>
                            <th>Tarif Harian</th>
                            <th>Lama Sewa</th>
                            <th>Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatSewa as $riwayat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $riwayat->tanggal_sewa }}</td>
                                <td>{{ $riwayat->tanggal_kembali ?? 'Belum Kembali' }}</td>
                                <td>{{ $riwayat->nomor_plat }}</td>
                                <td>{{ $riwayat->merek }}</td>
                                <td>{{ $riwayat->tarif_harian }}</td>
                                <td>{{ $riwayat->hitungLamaSewa() }}</td>
                                <td>{{ $riwayat->hitungLamaSewa() * $riwayat->tarif_harian }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section2">
            <h2>Data Penyewa</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Email Pengguna</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Nomor SIM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatSewa as $riwayat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $riwayat->nama }}</td>
                                <td>{{ $riwayat->email }}</td>
                                <td>{{ $riwayat->alamat }}</td>
                                <td>{{ $riwayat->nomor_telfon }}</td>
                                <td>{{ $riwayat->nomor_sim }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @foreach ($riwayatSewa as $selesai)
        <form action="{{ route('admin.selesaikanPenyewaan') }}" method="post" class="text-center">
        @csrf
                <input type="text" hidden name="id_mobil" id="id_mobil" value="{{ $selesai->id_mobil }}">
                <input type="text" hidden name="id_sewa" id="id_sewa" value="{{ $selesai->id_sewa }}">
                <input type="text" hidden name="id_pengguna" id="id_pengguna" value="{{ $selesai->id_pengguna }}">
                <input type="text" hidden name="tanggal_sewa" id="tanggal_sewa" value="{{ $selesai->tanggal_sewa }}">
                <input type="text" hidden name="tanggal_kembali" id="tanggal_kembali" value="">
                <input type="text" hidden name="jumlah_hari" id="jumlah_hari" value="{{ $riwayat->hitungLamaSewa() }}">
                <input type="text" hidden name="total_biaya" id="total_biaya" value="{{ $riwayat->hitungLamaSewa() * $riwayat->tarif_harian }}">
            <button type="submit" class="btn btn-primary text-center">Selesaikan penyewaan</button>
            <a href="{{ route('admin.riwayat_admin') }}"><button type="button" class="btn btn-danger text-center">kembali</button></a>
        </form>

        
        @endforeach
    @else
        <p>Tidak ada riwayat penyewaan.</p>
    @endif
</div>
<script>
    function updateClock() {
        var now = new Date();

        // Mendapatkan komponen waktu
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var hour = ('0' + now.getHours()).slice(-2);
        var minute = ('0' + now.getMinutes()).slice(-2);
        var second = ('0' + now.getSeconds()).slice(-2);

        // Membentuk waktu dalam format yang diinginkan
        var formattedTime = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;

        // Update elemen dengan ID 'clock'

        // Update elemen input tersembunyi dengan ID 'tanggal_sewa'
        document.getElementById('tanggal_kembali').value = formattedTime;
    }
    setInterval(updateClock, 1000); // Update every 1000 milliseconds (1 second)
    updateClock()
</script>
@endsection
