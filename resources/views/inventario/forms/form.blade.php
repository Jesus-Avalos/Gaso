@if(count($errors))
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre del Artículo*: </label>
                {{ Form::text('nombre', null, ['class' => 'form-control','required']) }}
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="from-group">
                <label for="tipo">Tipo*: </label>
                {{ Form::select('tipo', ['Ingrediente' => 'Ingrediente', 'Material' => 'Material','Requerido'=>'Requerido','Desechable'=>'Desechable'], null, ['class' => 'selectpicker form-control','placeholder' => 'Selecciona...','required']) }}
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="from-group">
                <label for="unidad">Unidad*: </label>
                {{ Form::select('unidad', $unidades, null, ['class' => 'selectpicker form-control', 'placeholder' => 'Selecciona...','required']) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-3">
            <div class="form-group">
                <label for="cantidad">Cantidad*: </label>
                {{ Form::number('cantidad', @$articulo->cantidad ?: 0, ['class' => 'form-control','min'=>0,'step'=>'any','required']) }}
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="form-group">
                <label for="por_unidad">Porciones por unidad*: </label>
                {{ Form::number('por_unidad', @$articulo->por_unidad ?: 1, ['class' => 'form-control','min'=>1,'step'=>'any','required']) }}
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="form-group">
                <label for="precio_unidad">Precio por unidad*: </label>
                {{ Form::number('precio_unidad', @$articulo->precio_unidad ?: 0, ['class' => 'form-control','min'=>0,'step'=>'any','required']) }}
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="form-group">
                <label for="stock_min">Stock mínimo*: </label>
                {{ Form::number('stock_min', @$articulo->stock_min ?: 0, ['class' => 'form-control','min'=>0,'step'=>'any','required']) }}
            </div>
        </div>
    </div>
</div>