<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class TreatmentRecapsExport implements FromView, WithTitle
{
    use Exportable;
    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year = $year;
        $this->ENUM_TREATMENT_TYPE = ['Umum','Persalinan'];
        $this->ENUM_PATIENT_TYPE = ['Baru','Lama'];
        $this->ENUM_DOMICILE = ['DW','LW'];
        $this->ENUM_GENDER = ['Laki-Laki','Perempuan'];
        $this->ENUM_PAYMENT_TYPE = ['UM','ASK','JAMKESMAS','JAMKESDA','BPJS','KIS','SPM'];
        $this->ENUM_RELEASE_NOTE = ['Pulang','Dirujuk','Meninggal > 48 jam','Meninggal < 48 jam'];
    }

    /**
     * @return Builder
     */
    public function view(): View
    {
        $result[0][0] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Umum'],
                    ['age', '<=', '55'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][1] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Umum'],
                    ['age', '>', '55'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][2] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Umum'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][3] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Persalinan'],
                    ['age', '<=', '55'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][4] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Persalinan'],
                    ['age', '>', '55'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][5] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Persalinan'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;
        
        $result[0][6] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        

        //return $patients;
        return view('recaps.treatmentRecapsExport', compact('patients', 'year', 'month'));
    }

    private function countQueryBuilder($patientType,$domicile,$gender,$paymentType){
        $result[0] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Umum'],
                ['age', '<=', '55'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get())[0]->sum;

        $result[1] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Umum'],
                ['age', '>', '55'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get())[0]->sum;

        $result[2] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Umum'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get())[0]->sum;

        $result[3] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Persalinan'],
                ['age', '<=', '55'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get())[0]->sum;

        $result[4] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Persalinan'],
                ['age', '>', '55'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get())[0]->sum;

        $result[5] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Persalinan'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get())[0]->sum;

        $result[6] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get())[0]->sum;

        return $result;
    }

    private function daysQueryBuilder($paymentType,$domicile,$gender){
        $result[0] = (DB::table('patients')
            ->select(DB::raw('count(id) as days'))
            ->where([
                ['payment_type', $paymentType],
                ['domicile', $domicile],
                ['gender', $gender],
            ])
            ->whereYear('exit_date', $this->year)
            ->whereMonth('exit_date', $this->month)
            ->get())[0]->days;
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

        return "Pelayanan Perawatan " . $titleMonth . " " . $this->year;
    }
}
