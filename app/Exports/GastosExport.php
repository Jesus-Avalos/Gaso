<?php

namespace App\Exports;

use App\Gasto;
use Maatwebsite\Excel\Concerns\FromCollection;

class GastosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Gasto::all();
    }
}
