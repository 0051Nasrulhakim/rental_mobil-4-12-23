@extends('master')

@section('konten')
     
    
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
             <td class="text-center">

                <a class="btn btn-info" href="{{ route('dashboard.sewa',$product->id_mobil) }}">Sewa</a>

             </td>
         </tr>
         @endforeach
     </table>
   
     {!! $products->links() !!}
   
@endsection