<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class Logs implements FromQuery

{
    use Exportable;

    public function forYear(int $year)
    {
        $this->year = $year;
        echo $this->year;
        return $this;
    }

    public function query()
    {
            //   return       
        return DB::Connection('mysql2')
                    ->table('zkfetches')
                    ->where('empid', $this->year);
                 
                    
    }
}
