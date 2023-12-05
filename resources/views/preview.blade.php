@extends('master')

@section('konten')
<div class="tes" style="border: 1px solid; padding: 3px; display: flex;">
    <div class="identitas" style="border: 1px solid; width: 30%; padding: 1%; vertical-align: top; margin-right: 1%;">
        @if(isset($identitas))
        <h2>Identitas Penyewa</h2>
        <table class="table">
            <tr>
                <td>Nama</td>
                <td>{{ $identitas['nama'] }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $identitas['email'] }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $identitas['alamat'] }}</td>
            </tr>
            <tr>
                <td>Nomor Telfon</td>
                <td>{{ $identitas['nomor_telfon'] }}</td>
            </tr>
            <tr>
                <td>Nomor SIM</td>
                <td>{{ $identitas['nomor_sim'] }}</td>
            </tr>
            <!-- Tambahkan baris lain jika diperlukan -->
        </table>
        @endif
    </div>

    <div class="produk" style="vertical-align: top; padding: 1%; width: 60%; text-align: center; ">
        @if(isset($product))
        <form action="{{ route('dashboard.checkout')}}" method="post">
            @csrf
            <h2>Informasi Produk yang Disewa</h2>
            <table class="table">
                <tr>
                    <th>Merek</th>
                    <th>Nomor Plat</th>
                    <th>Tarif Harian</th>
                    <th>Tanggal & Waktu Sewa</th> <!-- Tambahkan kolom tanggal & waktu -->
                </tr>
                <tr>
                    <td>{{ $product->merek }}</td>
                    <td>{{ $product->nomor_plat }}</td>
                    <td>{{ $product->tarif_harian }}</td>
                    <td id="clock"></td>
                    <input type="text" hidden name="tanggal_sewa" id="tanggal_sewa" value="">
                    <input type="text" hidden name="id_mobil" id="id_mobil" value="{{ $product->id_mobil }}">
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">Sewa Produk</button>
        </form>
        <a href="{{ route('dashboard') }}">
            <button type="button" class="btn btn-danger">Kembali ke Home</button>
        </a>
        @endif
    </div>
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
        document.getElementById('clock').innerText = formattedTime;

        // Update elemen input tersembunyi dengan ID 'tanggal_sewa'
        document.getElementById('tanggal_sewa').value = formattedTime;
    }

    setInterval(updateClock, 1000); // Update every 1000 milliseconds (1 second)
    updateClock(); // Initial update
</script>

@endsection