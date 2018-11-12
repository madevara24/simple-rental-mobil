<?php

namespace App\Http\Controllers;

use App\Car;
use App\Customer;
use App\Rental;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class RentalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = DB::table('rentals')
            ->leftJoin('customers', 'rentals.no_ktp', '=', 'customers.no_ktp')
            ->leftJoin('cars', 'rentals.plat_nomor', '=', 'cars.plat_nomor')
            ->paginate(10);

        //return $rentals;
        return view('rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $cars = Car::all();

        return view('rentals.create',compact('customers','cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required',
            'plat_nomor' => 'required',
            'mulai_rental' => 'required',
            'selesai_rental' => 'required',
        ]);
        $rental = new Rental([
            'no_ktp' => $request->get('no_ktp'),
            'plat_nomor' => $request->get('plat_nomor'),
            'mulai_rental' => $request->get('mulai_rental'),
            'selesai_rental' => $request->get('selesai_rental'),
        ]);
        $rental->save();
        return redirect('/rentals')->with('success', 'Data Rental Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rental = Rental::find($id);

            $customers = Customer::all();
            $cars = Car::all();
        return view('rentals.edit', compact('rental','customers','cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_ktp' => 'required',
            'plat_nomor' => 'required',
            'mulai_rental' => 'required',
            'selesai_rental' => 'required',
        ]);

        $rental = Rental::find($id);
        $rental->plat_nomor = $request->input('plat_nomor');
        $rental->no_ktp = $request->input('no_ktp');
        $rental->mulai_rental = $request->input('mulai_rental');
        $rental->selesai_rental = $request->input('selesai_rental');

        $rental->save();
        return redirect('/rentals')->with('success', 'Data Rental Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rental = Rental::find($id);
        $rental->delete();

        return redirect('/rentals')->with('success', 'Data Rental Berhasil Dihapus');
    }
}
