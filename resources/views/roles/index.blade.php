@extends('layouts.app')

@section('main-content')
<div class="container">
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Listado de Roles</h3>
            {{ link_to('roles/create', $title = 'Agregar', $attributes = ['class' => 'btn btn-sm btn-success float-right']) }}
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            <table class="table table-striped table-bordered table-responsive" id="basicTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th colspan="3" width="10%"><i class="fas fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        @can('roles.show')
                        <td>
                            <a href="{{ route('roles.show', $role->id) }}" 
                            class="btn btn-sm btn-secondary">
                                <i class="fas fa-bars"></i>
                            </a>
                        </td>
                        @endcan
                        @can('roles.edit')
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" 
                            class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        @endcan
                        @can('roles.destroy')
                        <td>
                            {!! Form::open(['route' => ['roles.destroy', $role->id], 
                            'method' => 'DELETE']) !!}
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $roles->render() }}
        </div>
    </div>
</div>
@endsection