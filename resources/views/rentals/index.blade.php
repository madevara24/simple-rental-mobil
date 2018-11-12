@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-2">Data Rental</h1>
    </div>
    <div class="row py-2">
        <div class="float-left">
            <div class="card p-1">
                <a class="btn btn-primary" href="/rentals/create">Tambah Data</a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th class="align-middle">No KTP Peminjam</th>
                    <th class="align-middle">Nama Peminjam</th>
                    <th class="align-middle">Kendaraan</th>
                    <th class="align-middle">Mulai Rental</th>
                    <th class="align-middle">Selesai Rental</th>
                    <th colspan="2" class="align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                <tr>
                    <td>{{$rental->no_ktp}}</td>
                    <td>{{$rental->nama}}</td>
                    <td>{{$rental->tipe." ".$rental->plat_nomor}}</td>
                    <td>{{$rental->mulai_rental}}</td>
                    <td>{{$rental->selesai_rental}}</td>
                    <td><a href="{{ route('rentals.edit',$rental->id)}}" class="btn btn-primary btn-sm" class="text-center">Edit</a></td>
                    <td>
                        {!!Form::open(['action' => ['RentalsController@destroy',$rental->id], 'method' => 'POST', 'class' => 'text-center'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Hapus',['class'=>'btn btn-danger btn-sm'])}}
                        {!!Form::close()!!}
                    </td>                
                </tr>
                @endforeach
                        
            </tbody>
                    
        </table>
        {{ $rentals->links() }}
    </div>            
@endsection
