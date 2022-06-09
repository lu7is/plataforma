
//REGISTRAR TAREAS
$('#regi-tarea').submit(function (e) {
    
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
           // 
        

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

e.preventDefault();
});

//LISTAR TAREAS
function ListarTareas() {
    var action = 'listar';
    
$.ajax({

   url: '../../app/controladores/Tareas/listarTareas.php',
   type: 'GET',
   async: true,
   data:{action:action},

   
   success: function(response) {
       
   let tarea = JSON.parse(response);
   
   let template = '';
   tarea.forEach(tarea => {
       template +=` 
           <div class="card" taskId = " ${tarea.id} ">
           <div class="card-body " > 
           
                   <p> ${tarea.nombre} <h6>PRIORIDAD:</h6> ${tarea.prioridad}  </p>
                   <p> ${tarea.descrip} <h6>ESTADO:</h6> ${tarea.estado}  </p>
                   <a class="eliminar btn btn-danger" >Eliminar</a>  <a class=" editar btn btn-warning" data-bs-toggle="modal" data-bs-target="#registrar">Editar</a>
                   
                <div class="modal fade" id="registrar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                       <div class="modal-dialog modal-lg">
                               <div class="modal-content">
                                       <div class="modal-header">
                                       <h5 class="modal-title" id="modalTitle">Editar Tareas</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                                       </div>

                                       <div class="modal-body">
                                       <form id="registrar_modal" >

                                       <input type="hidden"  id="taskId" placeholder="Nombre" required >

                                       <div class="form-row d-flex">
                                         </div>
                                           
                                         <div class="form-row d-flex">
                                               <div class="form-group col-md-6 p-2">
                                               <label for="nombre">Nombre:</label>
                                               <input type="text" class="form-control" name="Nonbre" id="Nonbre" placeholder="Nombre" required >
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
                                             <label for="direccion">Estado:</label>
                                             <select class="form-select" name="Estado" id="Estado"required >
                                               <option selected>Selecciona El Rol </option>
                                               <option value="activo">Activo</option>
                                               <option value="inactivo">Inactivo</option>
                                               
                                             </select>
                                           </div>
                                           
                                           </div>
                                           
                                         <br>
                                      
                                       <button type="submit" class=" regi_tare btn btn-primary">Registrar Tarea</button>
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
               console.log(tarea);
               $('#lista').html(template);
               console.log(action);
           }

       });
   }