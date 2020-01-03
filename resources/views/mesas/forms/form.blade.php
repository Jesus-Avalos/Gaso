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
		{{ Form::hidden('status',1) }}
	</div>
</div>