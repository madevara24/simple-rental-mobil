@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Input Data Mobil</div>

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
                  {!! Form::open(['action'=>'CarsController@store','method'=>'POST', 'enctype' =>'multipart/data'] ) !!}
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label for="plat_nomor">Plat Nomor</label>
                        <input type="text" class="form-control" id="plat_nomor" placeholder="Plat Nomor" name="plat_nomor">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="tipe">Tipe</label>
                          <select class="form-control" id="tipe" name="tipe">
                            <option value="Sedan">Sedan</option>
                            <option value="Jeep">Jeep</option>
                            <option value="Pickup">Pickup</option>
                            <option value="Minibus">Minibus</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    {{Form::submit('Tambah',['class' => 'btn btn-primary'])}}
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
