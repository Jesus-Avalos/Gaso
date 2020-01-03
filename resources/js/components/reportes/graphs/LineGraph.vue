<template>
  <div>
    <line-chart :chart-data="datacollection" :options="options"></line-chart>
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
import LineChart from './LineChart.js'

  export default {
    components: {
      LineChart
    },
    data () {
      return {
        datacollection: null,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            height: 50
        }
      }
    },
    mounted () {
      this.fillData('semana')
    },
    methods: {
      fillData (opcion) {
        axios.get(`/reportes/graphs/sales/${opcion}`).then((response)=>{
            console.log(response.data.labels);
            this.datacollection = {
            labels: response.data.labels,
            datasets: [
                {
                label: 'Ventas',
                backgroundColor: '#f87979',
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