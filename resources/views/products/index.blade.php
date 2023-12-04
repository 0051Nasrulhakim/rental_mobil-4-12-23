@extends('products.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Mobil Tersedia DI Rental Kita</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Merek Mobil</th>
            <th>Nomor Plat</th>
            <th>Model</th>
            <th>Tarif Harian</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->merek }}</td>
            <td>{{ $product->nomor_plat }}</td>
            <td>{{ $product->model }}</td>
            <td>{{ $product->tarif_harian }}</td>
            <!-- <td>{{ $product->detail }}</td> -->
            <td>
                <form action="{{ route('products.destroy',$product->id_mobil) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id_mobil) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id_mobil) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection