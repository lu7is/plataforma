

$(document).ready(function(){
    $('#resultado').hide();

    $('#Nombre').keyup(function(e){
        if($('#Nombre').val()){
            let Nombre = $('#Nombre').val();
        $.ajax({
            url: '../../app/controladores/tareaBuscarController.php',
            type: 'POST',
            data:{Nombre},
            success: function(response){
                let datos = JSON.parse(response);
                let template = '';

                datos.forEach(datos =>{
                    template +=` <li> ${datos.nombre} </li>`
                });
                $('#container').html(template);
                $('#resultado').show();
            }
        });
        }
    });


$('#regi-tarea').submit(function (e) {
   
   
    const datos_post = {
        Nonbre: $('#Nonbre').val(),
        Descrip: $('#Descrip').val(),
        Prioridad: $('#Prioridad').val(),
        Estado: $('#Estado').val(),
       

    };
    
    $.post('../../app/controladores/Tareas/agregarTarea.php',datos_post,function(response){
        console.log(response);
        $('#regi-tarea').trigger('reset');
    });

    
    e.preventDefault();
});

});


  


