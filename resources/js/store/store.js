export default {
    state: {
        subtotal: 0,
        total: 0,
        descuento: 0,
        cont : 0,
        venta_id : 0
    },
    mutations: {
        agregaSub(state){
            var sum = 0;
            [].map.call(document.getElementsByClassName('subtotales'), function (item){
                sum += parseFloat(item.value);
            });
            state.subtotal = sum;
        },
        calculaTotal(state){
            state.total = state.subtotal - state.descuento;
        },
        defineState(state,payload){
            state.venta_id = payload.venta_id;
            state.subtotal = payload.subtotal;
            state.descuento = payload.descuento;
            state.total = payload.total;
        },
        updateDescuento(state,payload){
            state.descuento = payload;
        },
        saveData(state){
            const params = {
                subtotal : state.subtotal,
                descuento : state.descuento,
                total : state.total
            };
            axios.put('/comandas/saveData/'+state.venta_id,params).then(response => response.data);
        }
    },
    actions: {
        calcula({commit}){
            commit('agregaSub')
            commit('calculaTotal')
            commit('saveData')
        },
        defineState({commit},payload){
            commit('defineState',payload)
        },
        updateDescuento({commit},payload){
            commit('updateDescuento',payload)
            commit('calculaTotal')
            commit('saveData')
        }
    },
    getters : {
        getSubtotal(state){
            return state.subtotal;
        },
        getDescuento(state){
            return state.descuento;
        },
        getTotal(state){
            return state.total;
        }
    }
}