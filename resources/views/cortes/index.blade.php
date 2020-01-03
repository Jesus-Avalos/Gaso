@extends('layouts.app')

@section('main-content')
  @include('cortes.modals.modal')
  <cortes-component edit={{ Gate::allows('cortes.edit') }}></cortes-table-component>
@endsection