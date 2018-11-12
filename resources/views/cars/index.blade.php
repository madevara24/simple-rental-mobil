@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-2">Data Mobil</h1>
    </div>
    <div class="row py-2">
        <div class="float-left">
            <div class="card p-1">
                <a class="btn btn-primary" href="/cars/create">Tambah Data</a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th class="align-middle">Plat Nomor</th>
                    <th class="align-middle">Tipe</th>
                    <th colspan="2" class="align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td>{{$car->plat_nomor}}</td>
                    <td>{{$car->tipe}}</td>
                    <td><a href="{{ route('cars.edit',$car->id)}}" class="btn btn-primary btn-sm" class="text-center">Edit</a></td>
                    <td>
                        {!!Form::open(['action' => ['CarsController@destroy',$car->id], 'method' => 'POST', 'class' => 'text-center'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Hapus',['class'=>'btn btn-danger btn-sm'])}}
                        {!!Form::close()!!}
                    </td>                
                </tr>
                @endforeach
                        
            </tbody>
                    
        </table>
        {{ $cars->links() }}
    </div>            
@endsection
