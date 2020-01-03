<div class="box box-solid box-primary">
  <div class="box-header">
    <h3 class="box-title">Actualizar Categoría</h3>
  </div>
  <div class="box-body">
    {{Form::model($mesa,['route'=>['mesas.update', $mesa->id],'method'=>'PUT'])}}
    {{Form::token()}}
    <div style="padding-right: 10%; padding-left: 10%;">
      <div class="row">
        <div class="form-group">
          {{ Form::label('name','Nombre de la mesa:') }}
          {{ Form::text('name', null, ['class'=>'form-control']) }}
        </div>
        <div class="form-group">
          {{ Form::label('description','Descripcion (opcional):') }}
          {{ Form::textarea('description', null, ['class'=>'form-control','rows'=>3,'style'=>'resize:none;']) }}
        </div>
        <div class="form-group">
          {{ Form::hidden('status') }}
        </div>
      </div>
    </div>
    <div class="float-right">
      <button type="reset" name="button" class="btn btn-info">Reset</button>
      <button type="submit" name="button" class="btn btn-success">Actualizar</button>
    </div>
    {{Form::close()}}
  </div>
</div>