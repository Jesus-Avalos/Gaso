<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
        	'name'			=>	'Inventario',
        	'slug'			=>	'inventario.read',
        	'description'	=>	'Listar y navegar inventario del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Inventario',
            'slug'          =>  'inventario.edit',
            'description'   =>  'Edita inventario del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Configuracion',
        	'slug'			=>	'configuracion.read',
        	'description'	=>	'Listar y navegar configuracion del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Configuracion',
            'slug'          =>  'configuracion.edit',
            'description'   =>  'Edita configuracion del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Avanzado',
        	'slug'			=>	'avanzado.read',
        	'description'	=>	'Listar y navegar avanzado del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Avanzado',
            'slug'          =>  'avanzado.edit',
            'description'   =>  'Edita avanzado del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Ventas',
        	'slug'			=>	'ventas.read',
        	'description'	=>	'Listar y navegar ventas del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Ventas',
            'slug'          =>  'ventas.edit',
            'description'   =>  'Edita ventas del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Clientes',
        	'slug'			=>	'clientes.read',
        	'description'	=>	'Listar y navegar clientes del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Clientes',
            'slug'          =>  'clientes.edit',
            'description'   =>  'Edita clientes del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Compras',
        	'slug'			=>	'compras.read',
        	'description'	=>	'Listar y navegar compras del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Compras',
            'slug'          =>  'compras.edit',
            'description'   =>  'Edita compras del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Pedidos',
        	'slug'			=>	'pedidos.read',
        	'description'	=>	'Listar y navegar pedidos del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Pedidos',
            'slug'          =>  'pedidos.edit',
            'description'   =>  'Edita pedidos del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Mesas',
        	'slug'			=>	'mesas.read',
        	'description'	=>	'Listar y navegar mesas del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Mesas',
            'slug'          =>  'mesas.edit',
            'description'   =>  'Edita mesas del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Reportes',
        	'slug'			=>	'reportes.read',
        	'description'	=>	'Listar y navegar reportes del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Reportes',
            'slug'          =>  'reportes.edit',
            'description'   =>  'Edita reportes del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Cortes',
        	'slug'			=>	'cortes.read',
        	'description'	=>	'Listar y navegar cortes del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Cortes',
            'slug'          =>  'cortes.edit',
            'description'   =>  'Edita cortes del sistema',
        ]);
        Permission::create([
        	'name'			=>	'Cobros',
        	'slug'			=>	'cobros.read',
        	'description'	=>	'Listar y navegar cobros del sistema',
        ]);
        //EDIT
        Permission::create([
            'name'          =>  'Cobros',
            'slug'          =>  'cobros.edit',
            'description'   =>  'Edita cobros del sistema',
        ]);
    }
}
