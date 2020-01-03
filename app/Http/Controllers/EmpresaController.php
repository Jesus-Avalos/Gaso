<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:avanzado.edit')->only(['edit','update']);
    }

    public function edit()
    {
        $datos = Empresa::find(1);
        $impresoras = $this->getImpresoras();
        return view('empresa.edit',compact('datos','impresoras'));
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);
        $empresa->name = $request->get('name');
        $empresa->direccion = $request->get('direccion');
        $empresa->impresora = $request->impresora;
        if($request->hasFile('logo'))
        {
            if (\Storage::exists('public/'.$empresa->logo)) {
                \Storage::delete('public/'.$empresa->logo);
            }
            $file = $request->file('logo');
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = 'logo' . '.' . $extension;
            $empresa->logo = $filename;
            $file->storeAs('public/',$filename);
        }
        $empresa->update();

        return redirect('empresa');
    }

    function getImpresoras(){
        $ruta_powershell = 'c:\Windows\System32\WindowsPowerShell\v1.0\powershell.exe'; #Necesitamos el powershell
        $opciones_para_ejecutar_comando = "-c";#Ejecutamos el powershell y necesitamos el "-c" para decirle que ejecutaremos un comando
        $espacio = " "; #ayudante para concatenar
        $comillas = '"'; #ayudante para concatenar
        $comando = 'get-WmiObject -class Win32_printer |ft shared, name'; #Comando de powershell para obtener lista de impresoras
        $delimitador = "True"; #Queremos solamente aquellas en donde la línea comienza con "True"
        $lista_de_impresoras = array(); #Aquí pondremos las impresoras
        exec(
            $ruta_powershell
            . $espacio
            . $opciones_para_ejecutar_comando
            . $espacio
            . $comillas
            . $comando
            . $comillas,
            $resultado,
            $codigo_salida);
        if ($codigo_salida === 0) {
            if (is_array($resultado)) {
                #Omitir los primeros 3 datos del arreglo, pues son el encabezado
                for($x = 3; $x < count($resultado); $x++){
                    $impresora = trim($resultado[$x]);
                    # Ignorar los espacios en blanco o líneas vacías
                    if (strlen($impresora) > 0) {
                        # Comprobar si comienzan con "True", para ello usamos el delimitador declarado arriba
                        if (strpos($impresora, $delimitador) === 0){
                            #Limpiar el nombre
                            $nombre_limpio = substr($impresora, strlen($delimitador) + 1, strlen($impresora) - strlen($delimitador) + 1);
                            #Finalmente agregarla al array
                            array_push($lista_de_impresoras, $nombre_limpio);
                        }
                    }
                }
            }

            return $lista_de_impresoras;
        } else {
            echo "Error al ejecutar el comando.";
        }
    }
}
