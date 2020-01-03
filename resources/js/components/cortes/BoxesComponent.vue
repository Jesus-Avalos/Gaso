<template>
  <div class="row justify-content-center">
      <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Corte x</h3>
              <p>Solo detalles</p>
            </div>
            <div class="icon">
              <i class="fa fa-list"></i>
            </div>
            <a href="/cortes/ventas" class="small-box-footer">Realizar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>Corte z</h3>
              <p>Corte definitivo</p>
            </div>
            <div class="icon">
              <i class="fa fa-list"></i>
            </div>
            <a href="#" @click="modalCorte()" class="small-box-footer" v-if="edit">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    props: [
      'edit'
    ],
    methods: {
        modalCorte(){
            var cf = confirm('Confirmar corte de caja definitivo..');
            if(cf){
                $('.modalCorte').modal('show');
            }
        }
    }
}
</script>

<style>

</style>