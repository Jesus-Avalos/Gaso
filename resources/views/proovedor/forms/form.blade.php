<div class="row">
    <div class="col-12">
        <div class="from-group">
            <label for="nombre">Nombre*: </label>
            {{ Form::text('nombre', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="from-group">
            <label for="domicilio">Domicilio: </label>
            {{ Form::text('domicilio', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="from-group">
            <label for="colonia">Colonia: </label>
            {{ Form::text('colonia', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
  <div class="row">
    <div class="col-12 col-md-6">
        <div class="from-group">
            <label for="referencia">Referencia: </label>
            {{ Form::text('referencia', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="from-group">
            <label for="telefono">Teléfono: </label>
            {{ Form::number('telefono', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>