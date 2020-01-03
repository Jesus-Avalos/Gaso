export default {
    state: {
        total: 0,
        cont : 0
    },
    mutations: {
        agregaSub(state){
            var sum = 0;
            [].map.call(document.getElementsByClassName('subtotales'), function (item){
                sum += parseFloat(item.value);
            });
            state.total = sum;
        }
    }
}