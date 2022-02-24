

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


$('#regi-tarea').submit(function(e) {
    const datos_post = {
        Nonbre: $('#Nonbre').val(),
        Descrip: $('#Descrip').val(),
        Prioridad: $('#Prioridad').val(),
        Estado: $('#Estado').val(),
    };
  $.post('../../app/controladores/tareas/agregarTarea.php',datos_post,function(response){
        
        console.log(response,Alerta());
        $('#regi-tarea').trigger('reset');
    });
    e.preventDefault();
});



function Alerta(){
    Swal.fire(
        'Exito!',
        'Tarea registrada!',
        'success'
      )
}

$.ajax({
    url:'../../app/controladores/Tareas/listarTareas.php',
    type:'GET',
    success:function(response){
        let tareas = JSON.parse(response);
        let template = '';

        tareas.forEach(tareas => {
            template +=` 
                <tr>
                    <td>${tareas.nombre} </td>
                    <td>${tareas.descrip}  </td>
                    <td>${tareas.prioridad}  </td>
                    <td>${tareas.estado}  </td>
                </tr>
            `
        });
        $('#lista').html(template);
    }

})






});


  


