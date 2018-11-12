<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class TreatmentRegistrationsExport implements FromView, WithTitle
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
        $patients = DB::table('patients')
            ->leftJoin('diseases', 'patients.disease_code', '=', 'diseases.disease_code')
            ->select('patients.id', 'no_rm', 'treatment_type', 'name', 'birthday', 'age', 'gender', 'patients.disease_code', 'domicile',
                'patient_type', 'entry_date', 'exit_date', 'payment_type', 'release_note', 'diseases.disease_name',
                DB::raw('DATEDIFF(exit_date,entry_date) as duration'))
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get();

        foreach ($patients as $patient) {
            if ($patient->duration < 1) {
                $patient->duration = 1;
            }

        }
        //return $patients;
        return view('recaps.treatmentRegistrationExport', compact('patients', 'year', 'month'));
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

        return "Register Ranap " . $titleMonth . " " . $this->year;
    }
}
