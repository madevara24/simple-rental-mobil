<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class RecapPerMonthExport implements FromView, WithTitle
{
    use Exportable;

    private $month;
    private $year;

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
        $time[0] = $this->year;
        $time[1] = $this->month;
        $listOfDiseases = DB::table('diseases')
            ->select('disease_code', 'disease_name')
            ->get();

        for ($i = 0; $i < count($listOfDiseases); $i++) {
            $totals[$i] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->count();

            $results[$i][0][0] = DB::table('patients')
                ->where([
                    ['disease_code', $listOfDiseases[$i]->disease_code],
                    ['gender', 'Laki-Laki'],
                    ['patient_type', 'Baru'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->count();
            $results[$i][0][1] = DB::table('patients')
                ->where([
                    ['disease_code', $listOfDiseases[$i]->disease_code],
                    ['gender', 'Laki-Laki'],
                    ['patient_type', 'Lama'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->count();
            $results[$i][0][2] = DB::table('patients')
                ->where([
                    ['disease_code', $listOfDiseases[$i]->disease_code],
                    ['gender', 'Perempuan'],
                    ['patient_type', 'Baru'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->count();
            $results[$i][0][3] = DB::table('patients')
                ->where([
                    ['disease_code', $listOfDiseases[$i]->disease_code],
                    ['gender', 'Perempuan'],
                    ['patient_type', 'Lama'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->count();

            for ($j = 0; $j < 18; $j++) {
                $results[$i][$j + 1][0] = DB::table('patients')
                    ->where([
                        ['disease_code', $listOfDiseases[$i]->disease_code],
                        ['gender', 'Laki-Laki'],
                        ['patient_type', 'Baru'],
                        ['age_class', $j],
                    ])
                    ->whereYear('exit_date', $this->year)
                    ->whereMonth('exit_date', $this->month)
                    ->count();

                $results[$i][$j + 1][1] = DB::table('patients')
                    ->where([
                        ['disease_code', $listOfDiseases[$i]->disease_code],
                        ['gender', 'Laki-Laki'],
                        ['patient_type', 'Lama'],
                        ['age_class', $j],
                    ])
                    ->whereYear('exit_date', $this->year)
                    ->whereMonth('exit_date', $this->month)
                    ->count();

                $results[$i][$j + 1][2] = DB::table('patients')
                    ->where([
                        ['disease_code', $listOfDiseases[$i]->disease_code],
                        ['gender', 'Perempuan'],
                        ['patient_type', 'Baru'],
                        ['age_class', $j],
                    ])
                    ->whereYear('exit_date', $this->year)
                    ->whereMonth('exit_date', $this->month)
                    ->count();

                $results[$i][$j + 1][3] = DB::table('patients')
                    ->where([
                        ['disease_code', $listOfDiseases[$i]->disease_code],
                        ['gender', 'Perempuan'],
                        ['patient_type', 'Lama'],
                        ['age_class', $j],
                    ])
                    ->whereYear('exit_date', $this->year)
                    ->whereMonth('exit_date', $this->month)
                    ->count();
            }
        }

        return view('recaps.dataKesakitanExport', compact('listOfDiseases', 'totals', 'results', 'time'));
    }

    /**
     * @return string
     */
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

        return $this->year . " " . $titleMonth;
    }

}
