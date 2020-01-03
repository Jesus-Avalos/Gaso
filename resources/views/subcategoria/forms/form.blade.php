<div style="padding-right: 10%; padding-left: 10%;">
	<div class="row">
		<div class="form-group col-xs-12">
			{{ Form::label('name', 'Nombre de la Subcategoría') }}
			{{ Form::text('name', null, ['class'=>'form-control']) }}
		</div>
	</div>
	
	@if (isset($cat))
		{{Form::hidden('categoria_id',$cat->id)}}
	@else
		{{Form::hidden('categoria_id')}}
	@endif

	<div class="row">
		<div class="form-group col-xs-12">
			{{ Form::label('imagen', 'Imagen') }}
			{{ Form::file('imagen',['onchange'=>'imagePreview(this)']) }}
		</div>
	</div>
</div>

@section('scripts')
	{{ Html::script('js/categorias.js') }}
@endsection