@extends('layouts.excel')

@section('main-content')
    @include('excel.tables.'.$table)
@endsection