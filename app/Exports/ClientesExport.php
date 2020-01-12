<?php

namespace App\Exports;

use App\Cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('excel.tables.clientes', [
            'clientes' => Cliente::orderBy('id','DESC')->get()
        ]);
    }
}
