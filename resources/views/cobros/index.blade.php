@extends('layouts.app')

@section('htmlheader_title')
  {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
   <div class="alert alert-success" id="alertSuccess" role="alert" style="display: none;"></div>
      <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Listado de Cuentas por cobrar</h3>
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            <div class="body-responsive">
               <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
               @php 
                $cancelar = (Gate::allows('cancelar.edit')) ? 1 : 0; 
                $cobros = (Gate::allows('cobros.edit')) ? 1 : 0; 
              @endphp
               <table-cobro-component cancelar={{ $cancelar }} edit={{ $cobros }}></table-cobro-component>
            </div>
        </div>
    </div>
@endsection