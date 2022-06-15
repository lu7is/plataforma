


function ListarTarea(){
    $.ajax({
        url:'../../app/controladores/Tareas/listarTareas.php',
        type: 'get',
        success:function(response){

            console.log(response);
            


            
        }
    });
     
 }
 alert('hay no')