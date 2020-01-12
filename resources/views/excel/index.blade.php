@extends('layouts.app')

@section('main-content')
    <table class="table table-bordered">
        <thead class="bg-dark">
            <tr>
                <th>Módulo</th>
                <th><i class="fas fa-wrench"></i></th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($array as $item)
                <tr>
                    <td>{{ $item }} </td>
                    <td>
                        <a href="{{ route('export.'.strtolower($item)) }}" class="btn btn-success btn-sm">Excel</a>
                        <a href="#" class="btn btn-danger btn-sm">PDF</a>
                    </td>
                </tr>
            @endforeach --}}
            <tr>
                <td>Clientes</td>
                <td>
                <a href="{{ route('export.clientes') }}" class="btn btn-success">Excel</a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection