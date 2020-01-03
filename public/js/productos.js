function validarOne(input)
{
  if (input.value == "") {
    input.value = 1;
  }
}

function subcat(combo){
  var id = combo.value;
  $.get('/subcats/'+id, function(data){
    $('#sub').html(data);
    $('#sub').removeAttr('disabled');
    $('#sub').selectpicker('refresh');
  });
}

function validarZero(input)
{
  if (input.value == "") {
    input.value = 0;
  }
}

function editaProducto(id){
  $.get('producto/'+id+'/edit', function(data){
    $('#contenidoMain').html(data);
    $('#sub').removeAttr('disabled');
    total = parseInt($('#produccion').val());
    // existentes.push($('input[name="ingredientes_id[]"]').val());

    var inputs = $('input[name="ingredientes_id[]"]');

    for(var i = 0; i < inputs.length; i++)
    {
      existentes.push(parseInt(inputs[i].value));
    }
  });
}
