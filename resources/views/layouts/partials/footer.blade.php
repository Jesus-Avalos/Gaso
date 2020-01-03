<script>
  var rutaActual = window.location.pathname;
</script>

{{-- {{ Html::script('/js/comandas.js') }} --}}

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- {{ Html::script('js/jquery-ui.min.js') }} --}}

{{-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> --}}

{{ Html::script('js/app.js') }}
{{ Html::script('js/adminlte.min.js') }}
{{ Html::script('/js/datatables.min.js') }}
@yield('scripts')
{{-- {{ Html::script('/js/dataTableInit.js') }} --}}
{{-- {{ Html::script('js/select2Init.js') }} --}}
{{-- {{ Html::script('/js/ionic.min.js') }} --}}
{{-- {{ Html::script('/js/sidebar-routes.js') }} --}}
{{-- {{ Html::script('/js/ingredientes.js') }}
{{ Html::script('/js/categorias.js') }}
{{ Html::script('/js/productos.js') }}
{{ Html::script('/js/inventario.js') }}
{{ Html::script('/js/clientes.js') }}
{{ Html::script('/js/descuento.js') }}
{{ Html::script('/js/prints.js') }}
{{ Html::script('/js/stock.js') }}
{{ Html::script('/js/cobro.js') }}
{{ Html::script('/js/mesas.js') }}
{{ Html::script('/js/ticket.js') }} --}}
{{-- {{ Html::script('/js/users.js') }} --}}

