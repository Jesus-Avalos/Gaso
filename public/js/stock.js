function fcalculaStock(id){

	var stock = 0;

	$.ajax({
	    url : "/getStock/"+id,
	    type : "get",
	    async: false,
	    success : function(data) {
	       stock = data - fcalculaCantArray(id);
	    }
	});

	return stock;

}