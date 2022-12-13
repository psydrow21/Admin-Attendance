<?php

namespace App\Exports;

use App\Models\zkfetche;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class zkfetches implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::Connection('mysql2')
                ->table('zkfetches')
                ->select('empid', 'type', (DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")')), (DB::raw('TIME_FORMAT(logs, "%H:%i:%s")')))
                ->orderBy('empid', 'asc')
                ->get();
    }
}

