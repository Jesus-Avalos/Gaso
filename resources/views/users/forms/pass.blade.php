<div class="form-group row">
    <label for="mypassword" class="col-md-4 col-form-label text-md-right">{{ __('Actual password') }}</label>

    <div class="col-md-6">
        {{ Form::password('mypassword',['class'=>'form-control','required']) }}

        <div class="text-danger">
            <strong>{{ $errors->first('mypassword') }}</strong>
        </div>
    </div>
</div>
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