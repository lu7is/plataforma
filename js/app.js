

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


$('#task-form').submit(function (e) {
   
   
    const datos_post ={
        name: $('#name').val(),
        descripcion: $('#descripcion').val(),
       

    };
    $.post('../../app/controladores/buscarTarea.php',datos_post,function(response){
        console.log(response);
        $('#task-form').trigger('reset');
    });

    
    e.preventDefault();
});








    
    });


  


