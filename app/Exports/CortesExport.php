<?php

namespace App\Exports;

use App\Corte;
use Maatwebsite\Excel\Concerns\FromCollection;

class CortesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Corte::all();
    }
}
