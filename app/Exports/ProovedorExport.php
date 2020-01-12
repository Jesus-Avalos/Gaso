<?php

namespace App\Exports;

use App\Proovedor;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProovedorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Proovedor::all();
    }
}
