@extends('layouts.app')

@section('main-content')
<div class="container">
    <div class="row">
      @can('pedidos.read')
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>Pedido</h3>
            </div>
            <div class="icon">
              <i class="fas fa-clipboard-list"></i>
            </div>
            <a href="/pedido/create" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      @endcan
      <!-- ./col -->
      @can('comandas.read')
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>
                Mesas
              </h3>
            </div>
            <div class="icon">
              <i class="fas fa-clock"></i>
            </div>
            <a href="/mesas" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      @endcan
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>Compras</h3>
          </div>
          <div class="icon">
            <i class="fas fa-times-circle"></i>
          </div>
          <a href="/compra" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      @can('clientes.read')
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Clientes</h3>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="/cliente" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      @endcan
      <!-- ./col -->
    </div>
    <div class="row">
      
      @php
        $vacio = (count($stockMinimo) > 0) ? TRUE:FALSE;
        $vacio2 = (count($stocks[0]) > 0) ? TRUE:FALSE;
      @endphp
      @if ($vacio2)
        <div class="col-md-6">
        <!-- Widget: user widget style 2 -->
          <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-primary">
              <h3 class="widget-user-username ml-0"><strong>Existencia de productos</strong></h3>
              <small class="ml-0"><b>Nota: </b><i>El stock mínimo de todos los productos es 10.</i></small>
            </div>
            <div class="card-footer p-0">
              <ul class="nav flex-column">
                @for ($i = 0; $i < count($stocks[0]); $i++)
                  @php $color = ($stocks[1][$i] < 11) ? 'danger':'success'; @endphp
                    <li class="nav-item nav-link">
                      <strong>{{ $stocks[0][$i]->name }}</strong> <span class="float-right badge bg-{{ $color }}">{{ $stocks[1][$i] }}</span>
                    </li>
                @endfor
              </ul>
            </div>
          </div>
        @endif
        <!-- /.widget-user -->
      </div>
        
      @if ($vacio)
        <div class="col-md-6">
          <!-- Widget: user widget style 2 -->
          <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-danger">
              <h3 class="widget-user-username ml-0"><strong>Stock mínimo inventario</strong></h3>
            </div>
            <div class="card-footer p-0">
              <ul class="nav flex-column">
                  @foreach($stockMinimo as $stock)
                    <li class="nav-item nav-link">
                      <strong>{{ $stock->nombre }}</strong> <span class="float-right badge bg-danger">{{ $stock->porciones }}</span>
                    </li>
                  @endforeach
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
      @endif
    </div>
</div>
@endsection
