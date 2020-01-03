<template>
  <div>
    <h3 align="center">Top 5 - {{ op }}</h3>
    <pie-chart :chart-data="datacollection" :options="options"></pie-chart>
    <div class="row text-center">
        <div class="col-12 col-md-4 mt-2">
            <button @click="fillData('semana')" class="btn btn-primary">Semana Actual</button>
        </div>
        <div class="col-12 col-md-4 mt-2">
            <button @click="fillData('mes')" class="btn btn-primary">Mes Actual</button>
        </div>
        <div class="col-12 col-md-4 mt-2">
            <button @click="fillData('año')" class="btn btn-primary">Año Actual</button>
        </div>
    </div>
  </div>
</template>

<script>
import PieChart from './PieChart.js'

  export default {
    components: {
      PieChart
    },
    data () {
      return {
        datacollection: null,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            height: 50
        },
        op : 'semana'
      }
    },
    mounted () {
      this.fillData('semana')
    },
    methods: {
      fillData (opcion) {
        axios.get(`/reportes/graphs/products/${opcion}`).then((response)=>{
            this.op = opcion;
            this.datacollection = {
            labels: response.data.labels,
            datasets: [
                {
                label: 'Ventas',
                backgroundColor: response.data.colores,
                data: response.data.ventas
                }
            ]
            }
        })
      }
    }
  }
</script>

<style>
    
</style>