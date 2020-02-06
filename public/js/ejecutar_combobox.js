$(document).ready(function() {
    /*$.ajax({
      type: 'POST',
      url: '../../../model/DivPolitica/cbxProvincias.php'
    })
    .done(function(listas_rep){
      $('#cbx_provincias').html(listas_rep)
    })
    .fail(function(){
      alert('Hubo un errror al cargar las listas_rep')
    })*/

    $.ajax({
            type: 'POST',
            url: '../../../model/DivPolitica/cbxParroquias.php'
        })
        .done(function(listas_rep) {
            $('#cbx_parroquias').html(listas_rep)
        })
        .fail(function() {
            alert('Hubo un errror al cargar las listas_rep')
        })

    /*
      $('#cbx_provincias').on('change', function(){
        var id = $('#cbx_provincias').val();
        $.ajax({
          type: 'POST',
          url: 'model/DivPolitica/cbxCantones.php',
          data: {'id': id}
        })
        .done(function(listas_rep){
          $('#cbx_cantones').html(listas_rep)
        })
        .fail(function(){
          alert('Hubo un errror al cargar los vídeos')
        })
      })
      
      $('#cbx_cantones').on('change', function(){
        var id = $('#cbx_cantones').val();
        $.ajax({
          type: 'POST',
          url: 'model/DivPolitica/cbxParroquias.php',
          data: {'id': id}
        })
        .done(function(listas_rep){
          $('#cbx_parroquias').html(listas_rep)
        })
        .fail(function(){
          alert('Hubo un errror al cargar los vídeos')
        })
      })*/

    /*$('#enviar').on('click', function(){
      var resultado = 'Lista de reproducción: ' + $('#lista_reproduccion option:selected').text() +
      ' Video elegido: ' + $('#videos option:selected').text()
  
      $('#resultado1').html(resultado)
    })*/

})