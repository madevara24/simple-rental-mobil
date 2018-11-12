@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Data Rental</div>

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
                      {!! Form::open(['action'=>['RentalsController@update', $rental->id],'method'=>'POST'] ) !!}
                      <div class="form-group">
                          <div class="form-row">
                            <div class="col-md-12">
                              <label for="no_ktp">Peminjam</label>
                              <select class="form-control" id="no_ktp" name="no_ktp">
                                  <option value="{{$rental->no_ktp}}">{{$rental->no_ktp}}</option>
                                @foreach ($customers as $customer)
                                  <option value="{{$customer->no_ktp}}">{{$customer->no_ktp}}</option>
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
                                    <option value="{{$rental->plat_nomor}}">{{$rental->plat_nomor}}</option>
                                    @foreach ($cars as $car)
                                    <option value="{{$car->plat_nomor}}">{{$car->plat_nomor}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                              <div class="form-row">
                                <div class="col-md-6">
                                  <label for="mulai_rental">Tanggal Mulai Rental</label>
                                  <input value="{{$rental->mulai_rental}}" type="date" class="form-control" id="mulai_rental" name="mulai_rental" onchange=onChangeEntryDate()>
                                </div>
                                <div class="col-md-6">
                                  <label for="selesai_rental">Tanggal Selesai Rental</label>
                                  <input value="{{$rental->selesai_rental}}" type="date" class="form-control" id="selesai_rental" name="selesai_rental">
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
