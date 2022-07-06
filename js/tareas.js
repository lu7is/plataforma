//LISTAR TAREA
$(document).ready(function(){

  ListarTarea();

});

//REGISTRAR TAREAS
$('#regi-tarea').submit(function (e) {
  e.preventDefault();
   
   var Nombre = $('#Nombre').val();
   var Descrip = $('#Descrip').val();
   var Prioridad = $('#Prioridad').val();
   var Fecha = $('#Fecha').val();
   var action = 'registrar';

   $.ajax({
    url: '../../app/controladores/Tareas/tareaController.php', 
    method: 'POST',
    async:true,
    data:{action:action, Nombre:Nombre, Descrip:Descrip, Prioridad:Prioridad, Fecha:Fecha},

    success: function(response){
      Swal.fire({
       
        icon: 'success',
        title: 'Registrado Exítosamente!!',
        showConfirmButton: true,
        
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace("tareas.php"); 
        }
    })
      
    }
});


});

//LISTAR TODAS LAS TAREAS EN UNA TABLA
function ListarTarea(){
     var action = 'listar'
     $.ajax({
         url: '../../app/controladores/Tareas/tareaController.php',
         type: 'post',
         async:true,
         data:{action:action},
         success:function(response){
         let tareas = JSON.parse(response);
         let template = '';

         tareas.forEach(tareas => {
            template +=`
            
            <div class="card" taskId = "${tareas.id} ">
            <div class="card-body " > 
                    <h6>NOMBRE:</h6> 
                    <p> ${tareas.nombre_tarea} <div id="prioridad"><h6>PRIORIDAD:</h6> ${tareas.prioridad}  </p>
                    <div id="usuario"><h6>USUARIO:</h6> 
                    <p> ${tareas.nombre} </p> </div>         
                    </div>
                    <h6>DESCRIPCIÓN:</h6>          
                    <p> ${tareas.descrip} </p>
                    
                    <a class="eliminar btn btn-danger" >Eliminar</a>  <a class=" editar btn btn-warning" data-bs-toggle="modal" data-bs-target="#registrar">Editar</a>
                    
                 <div class="modal fade" id="registrar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                        <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitle">Editar Tareas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                                        </div>
 
                                        <div class="modal-body">
                                        <form id="registrar_tarea" >
 
                                        <input type="hidden"  id="taskId" >
 
                                        <div class="form-row d-flex">
                                          </div>
                                            
                                          <div class="form-row d-flex">
                                                <div class="form-group col-md-6 p-2">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre" required >
                                                </div>
                                            </div>
                                            <div class="form-row d-flex">
                                            <div class="form-group col-md-6 p-2">
                                              <label for="descrip">Descripción:</label>
                                              <textarea name="Descrip" id="Descrip" cols="30" rows="10" class="form-control" placeholder="Descripción"></textarea>
                                            </div>
                                            
                                            <div class="form-group col-md-6 p-2">
                                              <label for="direccion">Prioridad:</label>
                                              <select class="form-select" name="Prioridad" id="Prioridad" required >
                                                <option selected>Selecciona la prioridad </option>
                                                <option value="alta">Alta</option>
                                                <option value="media">Media</option>
                                                <option value="baja">Baja</option>
                                                <option value="ninguna">Ninguna</option>
                                                
                                              </select>
                                             
                                            </div>
                                            
                                            </div>
                                            
                                          <br>
                                       
                                        <button type="submit" class=" regiTask btn btn-primary">Registrar Tarea</button>
                                        <button type="button" class="btn bg-warning" data-bs-dismiss="modal" aria-label="close">Cancelar</button>
                                      </form>
                                        </div>
                                </div>
                        </div>
                 </div>
             </div>
        </div>
            
            
            `
         });
         $('#lista').html(template);
         }
     });   
    
}

//EDITAR TAREAS

$(document).on('click','.editar', function(){
  let element = $(this)[0].parentElement.parentElement;
  var Id = $(element).attr('taskId');
  var action ='editar';
  $.ajax({
    url:'../../app/controladores/tareas/tareaController.php',
    type: 'post',
    async:true,
    data:{action:action, Id:Id},

    success:function(response){
     const tareas = JSON.parse(response);
    $('#taskId').val(tareas.id)
    $('#Nombre').val(tareas.nombre_tarea);
    $('#Descrip').val(tareas.descrip);
    $('#Prioridad').val(tareas.prioridad);
}
  })

$('#registrar_tarea').submit(function(e){
  e.preventDefault();
  var Id = $('#taskId').val();
  var Nombre = $('#Nombre').val();
  var Descrip = $('#Descrip').val();
  var Prioridad = $('#Prioridad').val();
  var action = 'actualizar';

  $.ajax({
    url: '../../app/controladores/tareas/tareaController.php',
    method: 'POST',
    async:true,
    data:{action:action, Id:Id, Nombre,Nombre, Descrip:Descrip, Prioridad:Prioridad},

    success:function(response){
      console.log(response);
    }
  });


})







});
   