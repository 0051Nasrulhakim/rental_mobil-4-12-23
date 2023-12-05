@extends('master')

@section('konten')
<h4>Selamat Datang <b>{{Auth::user()->nama}}</b>, Anda Login sebagai <b>{{Auth::user()->role}}</b>.</h4>
<form action="{{ route('dashboard') }}" method="GET">
    <div class="form-group" style="display: flex;">
        <div class="text" style="margin-right: 1%;">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <select name="merek" class="form-control">
            <option value="">Semua Merek</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand }}">{{ $brand }}</option>
            @endforeach
            <!-- Tambahkan merek mobil lainnya sesuai kebutuhan -->
        </select>
    </div>

</form>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Merek Mobil</th>
        <th>Nomor Plat</th>
        <th>Model</th>
        <th>Tarif Harian</th>
        <th width="100px">Action</th>
    </tr>
    <?php $i = 1; ?>
    @foreach ($products as $product)
    <tr>
        <td>{{ $i++}}</td>
        <td>{{ $product->merek }}</td>
        <td>{{ $product->nomor_plat }}</td>
        <td>{{ $product->model }}</td>
        <td>{{ $product->tarif_harian }}</td>
        <!-- <td>{{ $product->detail }}</td> -->
        <td>
            @if($product->status == 'disewa')
            <span class="btn btn-secondary" disabled>Mobil Disewa</span>
            @else
            <a class="btn btn-info" href="{{ route('dashboard.sewa', $product->id_mobil) }}">Sewa Mobil</a>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection