<div class="form-group">
	{{ Form::label('name', 'Nombre de la etiqueta') }}
	{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
	{{ Form::label('slug', 'URL Amigable') }}
	{{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
</div>
<div class="form-group">
	{{ Form::label('description', 'Descripción') }}
	{{ Form::textarea('description', null, ['class' => 'form-control','rows' => '3']) }}
</div>
<hr>
<h3>Permiso especial</h3>
<div class="form-group">
 	<label>{{ Form::radio('special', 'all-access') }} Acceso total</label>
 	<label>{{ Form::radio('special', 'no-access') }} Ningún acceso</label>
</div>
<hr>
<h3>Lista de permisos</h3>
{{-- <div class="form-group">
	<ul class="list-unstyled">
		@foreach($permissions as $permission)
	    <li>
	        <label>
	        {{ Form::checkbox('permissions[]', $permission->id, null) }}
	        {{ $permission->name }}
	        <em>({{ $permission->description }})</em>
	        </label>
	    </li>
	    @endforeach
    </ul>
</div> --}}

<table class="table table-bordered">
	<thead class="bg-dark">
		<tr>
			<th style="width: 50%">Módulos</th>
			<th style="width: 25%">Lectura</th>
			<th style="width: 25%">Modificar(Crear, editar, eliminar)</th>
		</tr>
	</thead>
	<tbody>
		@for($i = 0; $i < count($permissions); $i+=2)
			<tr>
				<td>{{ $permissions[$i]->name }}</td>
				<td class="check-td">
					<div class="custom-control custom-switch">
						{{ Form::checkbox('permissions[]', $permissions[$i]->id, null,['id'=>'customSwitch'.$permissions[$i]->id,'class'=>'custom-control-input']) }}
						<label class="custom-control-label" for="customSwitch{{ $permissions[$i]->id }}"></label>
					</div>	
				</td>
				<td>
					<div class="custom-control custom-switch">
						{{ Form::checkbox('permissions[]', $permissions[$i+1]->id, null,['id'=>'customSwitch'.$permissions[$i+1]->id,'class'=>'custom-control-input']) }}
						<label class="custom-control-label" for="customSwitch{{ $permissions[$i+1]->id }}"></label>
					</div>		
				</td>
			</tr>
		@endfor
	</tbody>
</table>