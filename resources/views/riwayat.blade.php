@extends('master')

@section('konten')
    <div class="riwayat">
        <h2>Riwayat Penyewaan</h2>
        <p><b>*Status Riwayat dan tanggal kembali hanya dapat di isi oleh admin ketika mengembalikan mobil</b></p>
        @if(count($riwayatSewa) > 0)
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Merek</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Nomor Plat</th>
                    <th>Status</th>
                    <th>Lama Sewa (hari)</th>
                    <th>Total Biaya</th>
                </tr>
                <?php $i = 1; ?>
                @foreach ($riwayatSewa as $riwayat)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $riwayat->merek }}</td>
                        <td>{{ $riwayat->tanggal_sewa }}</td>
                        <td>{{ $riwayat->tanggal_kembali ?? 'Belum Kembali' }}</td>
                        <td>{{ $riwayat->nomor_plat }}</td>
                        <td>{{ $riwayat->status }}</td>
                        <td>{{ $riwayat->hitungLamaSewa() }}</td>
                        <td>{{ $riwayat->hitungLamaSewa() * $riwayat->tarif_harian }}</td>
                    </tr>
                @endforeach
            </table>
            <a href="{{route('dashboard')}}"><button class="btn btn-danger">Kembali</button></a>
        @else
            <p>Tidak ada riwayat penyewaan.</p>
        @endif
    </div>
@endsection
