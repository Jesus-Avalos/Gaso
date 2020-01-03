
function imagePreview(input) {
    console.log('Hecho');
    filePreview(input);
};


function filePreview(input) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.readAsDataURL(input.files[0]);
      reader.onload = function (e) {
         $('#preview + img').remove();
         $('#preview').html('<img src="'+e.target.result+'" width="150" height="150"/>');
      }
   }
}

function editaCategoria(id) {
  $.get("/categoria/"+id+"/edit", function( data ) {
    $( "#contenido" ).html( data );
  });
}

function editaSub(id) {
  $.get("/subcategoria/"+id+"/edit", function( data ) {
    $( "#contenido" ).html( data );
  });
}
