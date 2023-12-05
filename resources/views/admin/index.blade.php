@extends('admin.layout')

@section('content')

<div class="daftar-menu" style="display: flex">
    <div class="btn ml-2">
        <a href="{{ route('products.index') }}">
            <button class="btn btn-primary">
                Management Mobil
            </button>
        </a>
    </div>
    <div class="btn ml-2">
        <a href="{{ route('admin.riwayat_admin') }}">
            <button class="btn btn-primary">
                Riwayat peminjaman
            </button>
        </a>
    </div>
</div>

@endsection