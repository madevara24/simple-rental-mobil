@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-2">Data Pelanggan</h1>
    </div>
    <div class="row py-2">
        <div class="float-left">
            <div class="card p-1">
                <a class="btn btn-primary" href="/customers/create">Tambah Data</a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>No KTP</th>
                    <th class="align-middle">Nama</th>    
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th colspan="2" class="align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{$customer->no_ktp}}</td>
                    <td>{{$customer->nama}}</td>
                    <td>{{$customer->alamat}}</td>
                    <td>{{$customer->tanggal_lahir}}</td>
                    <td>{{$customer->jenis_kelamin}}</td>
                    <td><a href="{{ route('customers.edit',$customer->id)}}" class="btn btn-primary btn-sm" class="text-center">Edit</a></td>
                    <td>
                        {!!Form::open(['action' => ['CustomersController@destroy',$customer->id], 'method' => 'POST', 'class' => 'text-center'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Hapus',['class'=>'btn btn-danger btn-sm'])}}
                        {!!Form::close()!!}
                    </td>                
                </tr>
                @endforeach
                        
            </tbody>
                    
        </table>
        {{ $customers->links() }}
    </div>            
@endsection
