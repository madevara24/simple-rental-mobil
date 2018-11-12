<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class TopTensExport implements FromView, WithTitle
{
    use Exportable;
    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * @return Builder
     */
    public function view(): View
    {
        $result['count'] = DB::table('patients')
            ->select(DB::raw('count(name) as total'), 'disease_code as code')
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->groupBy('code')
            ->orderBy('total', 'desc')
            ->get();

        for ($i = 0; $i < count($result['count']); $i++) {
            $result['count'][$i]->name = (DB::table('diseases')
                    ->select('disease_name')
                    ->where('disease_code', $result['count'][$i]->code)
                    ->pluck('disease_name'))[0];

            $result['count'][$i]->alive_male = (DB::table('patients')
                    ->select(DB::raw('count(name) as count'))
                    ->where([
                        ['gender', 'Laki-Laki'],
                        ['disease_code', $result['count'][$i]->code],
                    ])
                    ->where(function ($query) {
                        $query->where('release_note', 'Pulang')->orWhere('release_note', 'Dirujuk');
                    })
                    ->whereYear('exit_date', $this->year)
                    ->whereMonth('exit_date', $this->month)
                    ->get())[0]->count;

            $result['count'][$i]->alive_female = (DB::table('patients')
                    ->select(DB::raw('count(name) as count'))
                    ->where([
                        ['gender', 'Perempuan'],
                        ['disease_code', $result['count'][$i]->code],
                    ])
                    ->where(function ($query) {
                        $query->where('release_note', 'Pulang')->orWhere('release_note', 'Dirujuk');
                    })
                    ->whereYear('exit_date', $this->year)
                    ->whereMonth('exit_date', $this->month)
                    ->get())[0]->count;

            $result['count'][$i]->deceased_male = (DB::table('patients')
                    ->select(DB::raw('count(name) as count'))
                    ->where([
                        ['gender', 'Laki-Laki'],
                        ['disease_code', $result['count'][$i]->code],
                        ['release_note', 'like', 'Meninggal%'],
                    ])
                    ->whereYear('exit_date', $this->year)
                    ->whereMonth('exit_date', $this->month)
                    ->get())[0]->count;
            $result['count'][$i]->deceased_female = (DB::table('patients')
                    ->select(DB::raw('count(name) as count'))
                    ->where([
                        ['gender', 'Perempuan'],
                        ['disease_code', $result['count'][$i]->code],
                        ['release_note', 'like', 'Meninggal%'],
                    ])
                    ->whereYear('exit_date', $this->year)
                    ->whereMonth('exit_date', $this->month)
                    ->get())[0]->count;
        }
        $disease_count = count($result['count']);
        if ($disease_count > 10) {
            $disease_count = 10;
        }

        //return $request;
        return view('recaps.topTenExport', compact('result', 'disease_count'));
    }

    public function title(): string
    {
        $titleMonth = "";
        switch ($this->month) {
            case '1':$titleMonth = "Januari";
                break;
            case '2':$titleMonth = "Februari";
                break;
            case '3':$titleMonth = "Maret";
                break;
            case '4':$titleMonth = "April";
                break;
            case '5':$titleMonth = "Mei";
                break;
            case '6':$titleMonth = "Juni";
                break;
            case '7':$titleMonth = "Juli";
                break;
            case '8':$titleMonth = "Agustus";
                break;
            case '9':$titleMonth = "September";
                break;
            case '10':$titleMonth = "Oktober";
                break;
            case '11':$titleMonth = "November";
                break;
            case '12':$titleMonth = "Desember";
                break;
            default:$titleMonth = "";
                break;
        }

        return "10 Besar Penyakit " . $titleMonth . " " . $this->year;
    }
}
