require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
import StoreData from './store.js';

Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

//MESAS
Vue.component('mesas-component', require('./components/mesas/Mesas.vue').default);

//COMPRAS
Vue.component('compras-component', require('./components/compras/ComprasComponent.vue').default);
Vue.component('header-compras', require('./components/compras/Header.vue').default);
Vue.component('body-compras', require('./components/compras/Body.vue').default);
Vue.component('footer-compras', require('./components/compras/Footer.vue').default);
Vue.component('fila-compras', require('./components/compras/Fila.vue').default);

//GASTOS
Vue.component('gastos-component', require('./components/gastos/Gastos.vue').default);

//COBROS
Vue.component('cobro-component', require('./components/cobros/CobrosComponent.vue').default);
Vue.component('modal-cobro-component', require('./components/cobros/ModalCobrosComponent.vue').default);
Vue.component('table-cobro-component', require('./components/cobros/TableComponent.vue').default);
//REPORTES
Vue.component('reporte-component', require('./components/reportes/ReportesComponent.vue').default);
Vue.component('venta-component', require('./components/reportes/VentasComponent.vue').default);
Vue.component('fecha-component', require('./components/reportes/FechasComponent.vue').default);
Vue.component('reporte-table-component', require('./components/reportes/TableComponent.vue').default);
//GRAPHS
Vue.component('graphs-component', require('./components/reportes/graphs/GraphsComponent.vue').default);
Vue.component('line-graph', require('./components/reportes/graphs/LineGraph.vue').default);
Vue.component('bar-graph', require('./components/reportes/graphs/BarGraph.vue').default);
Vue.component('pie-graph', require('./components/reportes/graphs/PieGraph.vue').default);
//CORTES
Vue.component('ventas-cortes-component', require('./components/cortes/VentasCortesComponent.vue').default);
Vue.component('compras-cortes-component', require('./components/cortes/ComprasCortesComponent.vue').default);
Vue.component('cortes-component', require('./components/cortes/CortesComponent.vue').default);
Vue.component('table-cortes-component', require('./components/cortes/TableCortesComponent.vue').default);
Vue.component('boxes-component', require('./components/cortes/BoxesComponent.vue').default);
//UNIDADES
Vue.component('unidad-component', require('./components/unidades/UnidadComponent.vue').default);
Vue.component('unidades-component', require('./components/unidades/UnidadesComponent.vue').default);
Vue.component('form-unidad-component', require('./components/unidades/FormUnidadComponent.vue').default);
//REABASTECER
Vue.component('reabastecer-component', require('./components/reabastecer/ReabastecerComponent.vue').default);
Vue.component('form-rb-component', require('./components/reabastecer/FormRB.vue').default);
Vue.component('ings', require('./components/reabastecer/ingsRB.vue').default);

const app = new Vue({
    el: '#app',
    store
});