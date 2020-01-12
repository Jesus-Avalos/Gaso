@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	
	<div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="generalTable" style="width: 100%">
				<thead class="thead-dark">
					<tr>
						<th>Folio</th>
						<th>Cliente</th>
						<th>Tipo</th>
						<th>Mesa</th>
						<th>Tipo pago</th>
						<th>Total</th>
						<th>Status</th>
						<th><i class="fa fa-wrench"></i></th>
					</tr>
				</thead>
				<tbody>
					@foreach($ventas as $venta)

						<?php $tipo = ($venta->status == 'Exitosa') ? 'success' : 'danger' ?>
						<tr>
							<td> {{$venta->id}} </td>
							<td>{{ $venta->cliente }}</td>
							<td>{{$venta->tipo}}</td>
							<td>{{ ($venta->mesa != '') ? $venta->mesa : 'No aplica' }}</td>
							<td>{{$venta->tipoPago}}</td>
							<td>$ {{$venta->total}}</td>
							<td><small class="label label-{{$tipo}}">{{$venta->status}}</small></td>
							<td>
								{{ link_to_route('venta.show', $title = "", $parameters = [$venta->id], $attributes = ["class"=>"btn fa fa-bars btn-primary btn-sm","title"=>"Detalle"]) }}
								@can('ventas.edit')
									<button class="btn btn-sm btn-warning" title="Ticket Cocina"><i class="fa fa-coffee"></i></button>
									<button class="btn btn-sm btn-secondary" title="Ticket Cliente" onclick="ticketCompra({{ $venta->id }})"><i class="fa fa-user"></i></button>
								@endcan
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
        </div>
    </div>
@endsection

@section('scripts')
	{{ Html::script('js/dataTableInit.js') }}
	{{ Html::script('js/ticket.js') }}
@endsection