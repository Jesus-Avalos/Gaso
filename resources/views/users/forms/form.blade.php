<div class="form-group row">
    <label for="name" class="col-12 col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

    <div class="col-md-6">
        {{ Form::text('name',old('name'),['class'=>'form-control','required']) }}

        <div class="text-danger">
            <strong>{{ $errors->first('name') }}</strong>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-12 col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

    <div class="col-12 col-md-6">
        {{ form::email('email',null,['class'=>'form-control','required','autocomplete'=>'off']) }}

        <div class="text-danger">
            <strong>{{ $errors->first('email') }}</strong>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="url" class="col-12 col-md-4 col-form-label text-md-right">{{ __('Foto de perfil') }}</label>

    <div class="col-12 col-md-6">
        {{ form::file('imagen',null,['class'=>'form-control','autocomplete'=>'off']) }}
    </div>
</div>

<div class="form-group row">
    <label for="role_id" class="col-12 col-md-4 col-form-label text-md-right">
        <h4>Listado de roles</h4>
    </label>   
    <div class="col-12 col-md-6">
        <ul class="list-unstyled">
            @foreach ($roles as $role)
                <li>
                    <label>
                        {{ form::checkbox('roles[]',$role->id,null) }}
                        {{ $role->name }}
                        <em>({{ $role->description ?: 'Sin descripción' }})</em>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@isset($user)
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password Admin') }}</label>

        <div class="col-md-6">
            {{ Form::password('password',['class'=>'form-control','required']) }}

            <div class="text-danger">
                <strong>{{ $errors->first('password') }}</strong>
            </div>
        </div>
    </div>
@endisset
@if(!isset($user))
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nuevo password') }}</label>

        <div class="col-md-6">
            {{ Form::password('password',['class'=>'form-control','required']) }}

            <div class="text-danger"><strong>{{$errors->first('password')}}</strong></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirma password') }}</label>

        <div class="col-md-6">
            {{ Form::password('password_confirmation',['class'=>'form-control','required']) }}
        </div>
    </div>
@endif

