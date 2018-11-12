@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Pelanggan</div>

                <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                        </div><br />
                      @endif
                      {!! Form::open(['action'=>['CustomersController@update', $customer->id],'method'=>'POST'] ) !!}
                      <div class="form-group">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label for="no_ktp">No KTP</label>
                            <input value="{{$customer->no_ktp}}" type="text" class="form-control" id="no_ktp" placeholder="No KTP" name="no_ktp">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-row">
                          <div class="col-md-12">
                            <label for="nama">Nama</label>
                            <input value="{{$customer->nama}}" type="text" class="form-control" id="nama" placeholder="Nama" name="nama">
                          </div>
                        </div>
                      </div>
    
                      <div class="form-group">
                        <div class="form-row">
                          <div class="col-md-12">
                            <label for="alamat">Alamat</label>
                            <input value="{{$customer->alamat}}" type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat">
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="form-row">
                            <div class="col-md-6">
                              <label for="jenis_kelamin">Jenis Kelamin</label>
                              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="{{$customer->jenis_kelamin}}">{{$customer->jenis_kelamin}}</option>
                                <option value="L">L</option>
                                <option value="P">P</option>
                              </select>
                            </div>
                          </div>
                        </div>
    
                        <div class="form-group">
                          <div class="form-row">
                            <div class="col-md-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input value="{{$customer->tanggal_lahir}}" type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                          </div>
                        </div>
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Update',['class' => 'btn btn-primary'])}}
                      {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
