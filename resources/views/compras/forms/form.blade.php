<div class="row">
    <div class="form-group col-12">
        <label for="">Proovedor</label>
        <select name="proovedor_id" class="form-control w-50">

        </select>
    </div>
    <div class="form-group col-12 col-md-6">
        <label for="">Artículos</label>
        <select id="ing_id" class="form-control">
            
        </select>
    </div>
    <div class="form-group col-12 col-md-6 text-center">
        <label class="w-100"> </label>
        <button class="btn btn-info form-control w-50 mt-2" type="button">Agregar</button>
    </div>
</div>
    {{-- <div class="form-group col-12 col-md-3">
        <label for="">Cantidad</label>
        <input type="number" min="0" class="form-control">
    </div>
    <div class="form-group col-12 col-md-3">
        <label for="">Precio unidad</label>
        <input type="number" min="0" class="form-control">
    </div> --}}
<table class="table table-bordered mt-2">
    <thead class="bg-dark">
        <tr>
            <th>Artículo</th>
            <th>Cantidad</th>
            <th>Precio unidad</th>
            <th>Total</th>
            <th><i class="fas fa-wrench"></i></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <input type="hidden" name="inventario_id">
                Ingrediente
            </td>
            <td>
                <input type="number" min="1" step="any" name="cantidad" class="form-control">
            </td>
            <td>
                <input type="number" step="any" min="0" name="precio_unidad" class="form-control">
            </td>
            <td>
                Subtotal
            </td>
            <td>
                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
    </tbody>
</table>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered w-25 float-right">
            <tbody>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>1231</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-12">
        <button class="btn btn-success float-right">Realizar compra</button>
    </div>
</div>