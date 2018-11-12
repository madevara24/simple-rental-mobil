@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Input Data Rental</div>

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
                  {!! Form::open(['action'=>'RentalsController@store','method'=>'POST', 'enctype' =>'multipart/data'] ) !!}
                  <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label for="no_ktp">Peminjam</label>
                          <select class="form-control" id="no_ktp" name="no_ktp">
                            @foreach ($customers as $customer)
                              <option value="{{$customer->no_ktp}}">{{$customer->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label for="plat_nomor">Plat Nomor Kendaraan</label>
                            <select class="form-control" id="plat_nomor" name="plat_nomor">
                                @foreach ($cars as $car)
                                <option value="{{$car->plat_nomor}}">{{$car->tipe." ".$car->plat_nomor}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="form-row">
                            <div class="col-md-6">
                              <label for="mulai_rental">Tanggal Mulai Rental</label>
                              <input type="date" class="form-control" id="mulai_rental" name="mulai_rental" onchange=onChangeEntryDate()>
                            </div>
                            <div class="col-md-6">
                              <label for="selesai_rental">Tanggal Selesai Rental</label>
                              <input type="date" class="form-control" id="selesai_rental" name="selesai_rental">
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
