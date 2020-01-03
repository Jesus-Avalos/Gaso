@extends('layouts.app')


@section('main-content')
    {!! Form::model($datos, ['route'=>['empresa.update',$datos->id], 'method'=>'PUT','files'=>true]) !!}
        <div class="row justify-content-center">
            <div class="col-12 col-md-3 border">
                <div id="preview" class="text-center">
                    <img src="{{ asset('storage/' . $datos->logo) }}" class="img-responsive" width="200" height="200">
                </div>
            </div>
            <div class="col-12 col-md-9 row">
                <div class="col-12 col-md-7">
                    <div class="form-group">
                        <label>Nombre de la empresa*:</label>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Logo:</label><br>
                        {!! Form::file('logo', ['onchange'=>'filePreview(this)']) !!}
                    </div>
                    <div class="form-group">
                        <label class="w-100">Impresora tickets:</label>
                        {{-- {!! Form::select('direccion', null, ['class'=>'form-control']) !!} --}}
                        <select name="impresora" class="selectpicker">
                            @foreach ($impresoras as $item)
                                <option value="{{ $item }}" 
                                    @if($datos->impresora == $item) selected @endif>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dirección:</label>
                        {!! Form::text('direccion', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            
            <div class="w-100"></div>
            <div class="col-12 col-md-6 text-right">
                <button class="btn btn-secondary btn-sm" type="reset">Reset</button>
                <button class="btn btn-primary btn-sm" type="submit">Actualizar</button>
            </div>
        </div>
    {!! Form::close() !!}
@stop

@section('scripts')
    <script>
        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#preview + img').remove();
                    $('#preview').html('<img src="'+e.target.result+'" width="150" height="150"/>');
                }
            }
        }
    </script>
@endsection