<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
use DB;
use App\Venta;
use App\Cliente;
use App\Empresa;
use App\Mesa;

class TicketController extends Controller
{
    public function ticketCocina($id)
    {
        //DATOS DE LA BASE DE DATOS
    	$productos = DB::table('productos as p')
                            ->join('detalle_ventas as dv','dv.producto_id','=','p.id')
                            ->where('dv.venta_id','=',$id)
                            ->select('p.*','dv.ingredientes')
                            ->get();

        $venta = Venta::find($id);

        $cliente = Cliente::find($venta->cliente_id);

        if($venta->mesa_id != null){
            $mesa = Mesa::find($venta->mesa_id);
        }

        $ingsDif = [];

        foreach ($productos as $value) {
            $ingsProducto = DB::table('inventario as i')
                                ->join('detalle_productos as dp','dp.ingrediente_id','=','i.id')
                                ->where('dp.producto_id','=',$value->id)->get();
            $ingsSelected = json_decode($value->ingredientes);
            $ings = [];
            foreach ($ingsProducto as $value) {
                if(in_array($value->nombre, $ingsSelected) == false){ array_push($ings, $value->nombre); }
            }
            array_push($ingsDif, $ings);
        }

        //IMPRESION DE TICKET

        //ABRE IMPRESORA
        $empresa = Empresa::find(1);

        $connector = new WindowsPrintConnector($empresa->impresora);
        $printer = new Printer($connector);

        // $printer -> setJustification(Printer::JUSTIFY_CENTER);

        // if ($venta->tipo == 'Comanda') 
        // {
        //     $printer -> setTextSize(3,3);
        //     $printer -> text(new double($mesa->name));
        // }else
        // {
        //     $printer -> setTextSize(3,3);
        //     $printer -> text(new double('Pedido #' . $venta->id));
        // }

        // $printer -> selectPrintMode();

        foreach ($productos as $key => $value) {
            $printer -> setEmphasis(true);
            $printer -> text(new title($value->name));
            $printer -> setEmphasis(false);
            $printer -> text('Sin('. implode(',', $ingsDif[$key]) .')');
        }


        //CIERRA IMPRESORA
        // $printer -> cut();
        $printer -> close();
    }

    public function ticketCliente($id)
    {
    	$productos = DB::table('productos as p')
                            ->join('detalle_ventas as dv','dv.producto_id','=','p.id')
                            ->where('dv.venta_id','=',$id)
                            ->get();

        $venta = Venta::find($id);

        $cliente = Cliente::find($venta->cliente_id);
        $empresa = Empresa::find(1);

        $connector = new WindowsPrintConnector($empresa->impresora);
        $printer = new Printer($connector);

        $items = array();

        foreach ($productos as $key => $value) {
            $item = new item($value->cantidad, $value->name, number_format($value->precio_venta, 2, '.', ','), number_format($value->precio_total, 2, '.', ','));
            array_push($items, $item);
        }

        $logo = EscposImage::load('storage/'.$empresa->logo, false);

        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> bitImage($logo);
        
        $printer -> text(new title($empresa->name));
        $printer -> text(new title($empresa->direccion));
        $printer -> text(new title('Tel: 487 101 9100'));
        $printer -> text(new title('Jueves - Martes'));
        $printer -> text(new title('01:00 pm - 11:00 pm'));

        $printer -> selectPrintMode(Printer::MODE_UNDERLINE);
        $printer -> text(new item());

        $printer -> text(new item('Qty', 'Descripcion', 'P.U.', 'Total'));
        $printer -> selectPrintMode();

        foreach ($items as $item) {
            $printer -> text($item);
        }

        $printer -> selectPrintMode(Printer::MODE_UNDERLINE);
        $printer -> text(new item());
        $printer -> selectPrintMode();
        $printer -> feed(1);
        // $printer -> selectPrintMode(Printer::MODE_UNDERLINE);
        // $printer -> text(new item());

        // $printer -> text(new item('Qty', 'Descripción', 'P.U.', 'Total'));

        // $printer -> selectPrintMode();

        // foreach ($items as $item) {
        //     $printer -> text($item);
        // }

        // $printer -> selectPrintMode(Printer::MODE_UNDERLINE);
        // $printer -> text(new item());

        $printer -> text(new total('Subtotal:',number_format($venta->subtotal, 2, '.', ','),true));
        $printer -> text(new total('Descuento:',number_format($venta->descuento, 2, '.', ','),true));
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text(new total('Total:',number_format($venta->total, 2, '.', ','),true));
        $printer -> selectPrintMode();

        $printer -> feed(1);

        $printer -> text(new title('Gracias por su preferencia!!'));

        $printer -> cut();
        $printer -> close();

    }
}

class title
{
    private $name;
    public function __construct($name = '')
    {
        $this -> name = $name;
    }
    
    public function __toString()
    {
        $Cols = 48;
        $all = str_pad($this -> name, $Cols, ' ', STR_PAD_BOTH) ;

        return "$all\n";
    }
}

class double
{
    private $name;
    public function __construct($name = '')
    {
        $this -> name = $name;
    }
    
    public function __toString()
    {
        $Cols = 16;
        $all = str_pad($this -> name, $Cols, ' ', STR_PAD_BOTH) ;

        return "$all\n";
    }
}

class total
{
    private $name;
    private $price;
    private $dollar;
    public function __construct($name = '',$price = '', $dollar = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollar = $dollar;
    }
    
    public function __toString()
    {
        if($this->name != 'Total:')
        {
            $nameCols = 35;
            $signCols = 5;
            $priceCols = 8;

            $nameS = str_pad($this -> name, $nameCols, ' ', STR_PAD_LEFT);

            $sign = ($this -> dollar ? '$ ' : '');
            $signS = str_pad($sign, $signCols, ' ', STR_PAD_LEFT);
            $priceS = str_pad($this -> price, $priceCols, ' ', STR_PAD_LEFT);

            return "$nameS$signS$priceS\n";
        }else
        {
            $nameCols = 36;
            $priceCols = 12;

            $nameS = str_pad($this -> name, $nameCols, ' ', STR_PAD_LEFT);

            $sign = ($this -> dollar ? '$ ' : '');
            $priceS = str_pad($sign . $this -> price, $priceCols, ' ', STR_PAD_LEFT);

            return "$nameS$priceS\n";
        }
    }
}

class item
{
    private $qty;
    private $name;
    private $pu;
    private $price;
    private $dollarSign;
    public function __construct($qty = '', $name = '', $pu = '', $price = '', $dollarSign = false)
    {
        $this -> qty = $qty;
        $this -> name = $name;
        $this -> pu = $pu;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }
    
    public function __toString()
    {
        $qtyCols = 4;
        $nameCols = 30;
        $puCols = 7;
        $priceCols = 7;

        $qtyS = str_pad($this -> qty, $qtyCols, ' ', STR_PAD_BOTH);
        $nameS = str_pad($this -> name, $nameCols, ' ', STR_PAD_RIGHT);
        $puS = str_pad($this -> pu, $puCols, ' ', STR_PAD_BOTH);
        
        $sign = ($this -> dollarSign ? '$ ' : ' ');
        $priceS = str_pad($sign . $this -> price, $priceCols, ' ', STR_PAD_BOTH);
        return "$qtyS$nameS$puS$priceS\n";
    }
}