@extends('layouts.app')

@section('main-content')
	<div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Usuarios</h3>
            {{ link_to('/user/create', $title = 'Agregar', $attributes = ['class' => 'btn btn-success btn-sm float-right']) }}
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            @if (Session::has('status'))
                <hr />
                <div class='text-success'>
                    {{Session::get('status')}}
                </div>
                <hr />
            @endif
            <table class="table table-striped table-bordered dt-responsive nowrap" id="generalTable" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th><i class="fa fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($users as $user)
                        @include('users.delete')
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="/user/{{ $user->id }}/edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarUser{{ $user->id }}"><i class="fa fa-trash"></i></button>
                                {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE','id'=>'formUser'.$user->id]) !!}
                                {!! Form::close() !!}
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
@endsection