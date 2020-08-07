@if(count($errors))
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="alert alert-danger alertIngs" style="display: none">
    *Debes agregar al menos un ingrediente.
</div>
<div class="borin">
    <div class="row">
        <input type="hidden" name="status" value="Activo">
        <div class="col-12 col-md-2">
            <div class="from-group">
                <label for="codigo">Código: </label>
                {{ Form::text('codigo', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="nombre">Nombre del Producto*: </label>
                {{ Form::text('name', null, ['class' => 'form-control','required']) }}
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="from-group">
                <label for="categoria">Categoría*: </label>
                {{ Form::select('categoria_id', $categorias, null, ['class'=>'selectpicker form-control', 'placeholder'=>'Selecciona...','onchange'=>'subcat(this)','required']) }}
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="from-group">
                <label for="categoria">Subcategoría*: </label>
                {{ Form::select('subcategoria_id', $subcategorias, null, ['class' => 'selectpicker form-control', 'placeholder' => 'Selecciona...', @$producto->subcategoria_id ? '' : 'disabled', 'id'=>'sub']) }}
            </div>
        </div>
    </div>

    
    <div class="form-group row">
        <label for="url" class="col-12">{{ __('Imagen') }}</label>

        <div class="col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
                </div>
                <div class="custom-file">
                  <input type="file" name="imagen" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Selecciona archivo</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="form-group">
                <label for="descripcion">Descripción: </label>
                {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => '2', 'style' => 'resize: none;']) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="form-group">
                <label for="preparacion">Preparación: </label>
                {{ Form::textarea('preparacion', null, ['class' => 'form-control', 'rows' => '2', 'style' => 'resize: none;']) }}
            </div>
        </div>
    </div>

    <div class="row border-bottom pb-2">
        <div class="col-12 col-md-4">
            <div class="from-group">
                <label for="tiempo_preparacion">Tiempo de preparación: </label>
                {{ Form::number('tiempo_preparacion', @$producto->tiempo_preparacion ?: 0, ['class' => 'form-control','min'=>'0']) }}
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="form-group">
                <label for="precio_prod">Precio de Producción*: </label>
                {{ Form::number('precio_produccion', @$producto->precio_produccion ?: 0, ['class' => 'form-control produccion', 'readonly','min'=>'0','id'=>'produccion','step'=>'any']) }}
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="from-group">
                <label for="precio_venta">Precio de Venta*: </label>
                {{ Form::number('precio_venta', @$producto->precio_venta ?: 0, ['class' => 'form-control','min'=>'0','required','step'=>'any']) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="from-group">
                <label for="ingrediente">Ingredientes*: </label>
                <select name="ingrediente" id="ing_select" class="selectpicker form-control" data-live-search="true" style="width: 100%;" onchange="chgIng();">
                    <option value="">Selecciona..</option>
                    @foreach($ingredientes as $ing)
                        <option value="{{ $ing->id }}">{{ $ing->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="from-group">
                <label for="precio">Precio: </label>
                {{ Form::number('precioShow', 0, ['class' => 'form-control seling', 'readonly']) }}
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="from-group">
                <label for="porciones">Porciones: </label>
                {{ Form::number('porciones', 1, ['class' => 'form-control porciones','min'=>'1','id'=>'porciones','step'=>'any','onblur'=>'validarOne(this)']) }}
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="form-group text-center" style="padding-top: 5px;">
                <br>
                <button type="button" id="agregar" class="btn btn-primary" onclick="agregaIng();">Agregar</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive table-bordered">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Ingredientes</th>
                        <th>Porciones</th>
                        <th>Precio</th>
                        <th>Operacion</th>
                    </tr>
                </thead>
                <tbody id="ings">
                  @if (isset($ingredientesSelected))
                    @foreach ($ingredientesSelected as $ingrediente)
                      <tr id="fila{{$ingrediente->id}}" class="editMode ingsList">
                        <input type="hidden" name="ingredientes_id[]" class="idInput" value="{{$ingrediente->id}}">
                        <input type="hidden" id="precioUnit{{$ingrediente->id}}" value="{{$ingrediente->precio_porcion}}">
                        <td>{{$ingrediente->nombre}}</td>
                        <td>
                          <input type="number" min="1" name="porciones[]" value="{{$ingrediente->porciones}}" id="porcionInp{{$ingrediente->id}}" class="text-center" onkeyup="validarOne(this); chgPorcion({{$ingrediente->id}})">
                        </td>
                        <input type="hidden" name="precio[]" id="precioInp{{$ingrediente->id}}" class="precioInput" value="{{$ingrediente->precio}}">
                        <td id="precioTotal{{$ingrediente->id}}">{{$ingrediente->precio}}</td>
                        <td>
                          <button class="btn btn-danger btn-sm" type="button" onclick="eliminarFilaIng({{$ingrediente->id}});"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                    @endforeach
                  @else
                      <tr>
                          <td colspan="4">
                              <h3>Agrega al menos un ingrediente</h3>
                          </td>
                      </tr>
                  @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    {{ Html::script('js/ingredientes.js') }}
    {{ Html::script('js/productos.js') }}
    <script>
        var editMode = document.getElementsByClassName('editMode');
        if(editMode.length){
            $(document).ready(function(){
                var ids = document.getElementsByClassName('idInput');
                var precios = document.getElementsByClassName('precioInput');
                var values = [].map.call(ids, function(item) {
                    existentes.push(parseInt(item.value));
                });
                var values = [].map.call(precios, function(item) {
                    total += parseFloat(item.value);
                });
            });
        };

        $('.custom-file-input').on('change', function(event) {
            var inputFile = event.currentTarget;
            $(inputFile).parent()
                .find('.custom-file-label')
                .html(inputFile.files[0].name);
        });
    </script>
@endsection