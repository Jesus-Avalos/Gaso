<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ClientesExport;

use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function index()
    {
        $array = ['Cliente','Proovedores','Cortes','Gastos'];
        return view('excel.index', compact('array'));
    }

    public function exportClientes() 
    {
        return Excel::download(new ClientesExport, 'clientes_'.strftime("%d-%m-%Y").'.xlsx');
    }
}
