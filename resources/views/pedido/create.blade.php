@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="row">		
		<div class="col-12">
			@include('forms.datosVentaCP')
			<principal-component mesa="{{ @$mesa->name ?: '' }}" path="{{ url('/') }}" venta="{{ $venta }}"></principal-component>
		</div>
	</div>
@endsection