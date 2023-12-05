@extends('admin.layout')

@section('content')
<div class="container mt-4">
    @if($dataCashOut != null)
    <h1 class="text-center mb-2">RIWAYAT PENYEWAAN MOBIL SELESAI</h1>
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
                        <tr>
                            <td>1</td>
                            <td>{{ $dataCashOut->tanggal_sewa }}</td>
                            <td>{{ $dataCashOut->tanggal_kembali ?? 'Belum Kembali' }}</td>
                            <td>{{ $dataCashOut->nomor_plat }}</td>
                            <td>{{ $dataCashOut->merek }}</td>
                            <td>{{ $dataCashOut->tarif_harian }}</td>
                            <td>{{ $dataCashOut->jumlah_hari }}</td>
                            <td>{{ $dataCashOut->total_biaya }}</td>
                        </tr>
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
                        <tr>
                            <td>1</td>
                            <td>{{ $dataCashOut->nama }}</td>
                            <td>{{ $dataCashOut->email }}</td>
                            <td>{{ $dataCashOut->alamat }}</td>
                            <td>{{ $dataCashOut->nomor_telfon }}</td>
                            <td>{{ $dataCashOut->nomor_sim }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('admin.riwayat_admin') }}"><button type="button" class="btn btn-danger text-center">kembali</button></a>
        </div>
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
