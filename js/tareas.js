

$('#regi-tarea').submit(function (e) {
        alert('ehh claro')
   var Nombre = $('#Nombre').val();
   var Descrip = $('#Descrip').val();
   var Prioridad = $('#Prioridad').val();
   var Fecha = $('#Fecha').val();
   var action = 'registrar'
    $.ajax({
        url: '../../app/controladores/Tareas/tareaController.php', 
        method: 'POST',
        async:true,
        data:{action:action, Nombre:Nombre, Descrip:Descrip, Prioridad:Prioridad, Fecha:Fecha},

        success: function(response){
            window.location.replace("tareas.php"); 
        }
    })

e.preventDefault();
});
