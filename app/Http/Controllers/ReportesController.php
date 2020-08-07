<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Venta;
use DB;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:reportes.read')->only(['index','getSalesByDates','graphs']);
    }

    public function ventas()
    {
    	return view('reportes.ventas');
    }

    public function compras()
    {
    	return view('reportes.compras');
    }

    public function productos()
    {
    	return view('reportes.productos');
    }

    public function graphs()
    {
        return view('reportes.graphs');
    }

    public function graphsDataSales($opcion)
    {
        $selects = [];
        $ventasTemp = [];
        $ventas = [];
        $data = [];
        $labelsEn = [];
        $labelsEs = [];
        $colors = [];
        switch($opcion){
            case 'año':
                $labelsEn = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                $labelsEs = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                $datos = DB::select('CALL anioactual()');
            break;
            case 'mes':
                $numero = cal_days_in_month(CAL_GREGORIAN, intval(date('n')), intval(date('Y')));
                for ($i=1; $i <= $numero; $i++) { 
                    array_push($labelsEn,$i);
                    array_push($labelsEs,$i);
                }
                $datos = DB::select('CALL mesactual()');
            break;
            case 'semana':
                $labelsEn = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                $labelsEs = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado'];
                $datos = DB::select('CALL semanaactual()');
            break;
        }
        foreach ($datos as $value) {
            array_push($selects, $value->dia);
            array_push($ventasTemp, $value->ventas);
        }

        for ($i=0; $i < count($labelsEn); $i++) { 
            $color = '#' . substr(md5(rand()), 0, 6);
            if(in_array($color,$colors)){ $i--; }
            else{ array_push($colors,$color); }
        }

        foreach ($labelsEn as $value) {
            $bool = true;
            for ($i=0; $i < count($selects); $i++) { 
                if ($value == $selects[$i]) { array_push($ventas,$ventasTemp[$i]); $bool=false; break;};
            }
            if($bool){ array_push($ventas,0); }
        }
        $data['labels'] = $labelsEs;
        $data['ventas'] = $ventas;
        $data['colores'] = $colors;

    	return $data;
    }

    public function graphsDataProducts($opcion)
    {
        $colors = [];
        $labels = [];
        $ventas = [];
        switch($opcion){
            case 'año': $sql = '%Y'; break;
            case 'mes': $sql = '%m %Y'; break;
            case 'semana': $sql = '%V %X'; break;
        }

        for ($i=0; $i < 5; $i++) { 
            $color = '#' . substr(md5(rand()), 0, 6);
            if(in_array($color,$colors)){ $i--; }
            else{ array_push($colors,$color); }
        }

        $datos = DB::select('SELECT SUM(dv.cantidad) AS ventas, p.name FROM detalle_ventas as dv INNER JOIN productos as p on p.id = dv.producto_id WHERE date_format(dv.created_at,"'. $sql .'") = date_format(CURRENT_DATE(),"'. $sql .'") GROUP BY dv.producto_id ORDER BY count(*) DESC LIMIT 5');

        foreach ($datos as $value) {
            array_push($labels, $value->name);
            array_push($ventas, $value->ventas);
        }

        $data['labels'] = $labels;
        $data['ventas'] = $ventas;
        $data['colores'] = $colors;

    	return $data;
    }

    public function getSalesByDates(Request $request)
    {
        return DB::select('
            SELECT * FROM ventas AS v 
            WHERE DATE(created_at) BETWEEN "' . $request->fecha1 . '" AND "' . $request->fecha2 . '" 
            ORDER BY v.id DESC'
        );
    }

    public function getShopsByDates(Request $request)
    {
        return DB::select('
            SELECT * FROM compras AS c 
            WHERE DATE(created_at) BETWEEN "' . $request->fecha1 . '" AND "' . $request->fecha2 . '" 
            ORDER BY c.id DESC'
        );
    }

    public function getProductosByDates(Request $request){
        return  DB::select('
                    SELECT SUM(dv.cantidad) AS ventasNum, p.name
                    FROM ventas AS v
                    INNER JOIN detalle_ventas AS dv ON dv.venta_id = v.id
                    INNER JOIN productos as p ON p.id = dv.producto_id
                    WHERE DATE(v.created_at) BETWEEN "' . $request->fecha1 . '" AND "' . $request->fecha2 . '" 
                    GROUP BY dv.producto_id
                    ORDER BY ventasNum DESC'
                );
    }
    
    public function dataPDF(Request $request)
    {
        $datos = DB::select('SELECT * FROM ventas AS v WHERE DATE(created_at) BETWEEN "' . $request->fecha1 . '" AND "' . $request->fecha2 . '" order by v.id DESC');
        if(!empty($datos)){
            $pdf = PDF::make('reportes.pdf');
            return $pdf->stream();
        }else{ return "Nada"; }
    }
}
