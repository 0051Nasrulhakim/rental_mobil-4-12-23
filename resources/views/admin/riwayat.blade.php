@extends('admin.layout')

@section('content')
<div class="riwayat">
    <h2>Riwayat Penyewaan</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(count($riwayatSewa) > 0)
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Tanggal Sewa</th>
            <th>Tanggal Kembali</th>
            <th>Nomor Plat</th>
            <th>Status</th>
            <th>Lama Sewa (hari)</th>
            <th>Action</th>
        </tr>
        <?php $i = 1; ?>
        @foreach ($riwayatSewa as $riwayat)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $riwayat->tanggal_sewa }}</td>
            <td>{{ $riwayat->tanggal_kembali ?? 'Belum Kembali' }}</td>
            <td>{{ $riwayat->nomor_plat }}</td>
            <td>{{ $riwayat->status }}</td>
            <td>{{ $riwayat->hitungLamaSewa() }}</td>
            <td>
                <a href="{{ route('admin.detail', ['id_sewa' => $riwayat->id_sewa]) }}">
                    <button class="btn btn-success">Lihat</button>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="text-center">
        <a href="{{route('admin')}}"><button class="btn btn-danger">Kembali</button></a>
    </div>
    @else
    <p>Tidak ada riwayat penyewaan.</p>
    @endif
</div>
@endsection