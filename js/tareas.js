//LISTAR TAREA
$(document).ready(function(){

  ListarTarea();
  $('#regi-tarea').validate({
    rules:{
        Nombre:{
            required:true,
            minlength: 3,
            maxlength: 20,
            number:false
        },
        Descrip:{
            required:true,
            minlength: 10,
            maxlength: 50
        }
       


    },

    messages: {  
                
        Nombre: {
           required: "Por favor ingresa el nombre de la tarea ",
           minlength: "Tu nombre debe ser de no menos de 3 caracteres",
           maxlength: "Tu nombre no debe ser de mas de 20 caracteres",
           number: "Solo letras"
        },
        Descrip: {
           required: "Por favor ingresa una descripcion",
           minlength: "Tu descripcion debe ser de no menos de 5 caracteres de longitud"
        }
    }
});

})
//VALIDAR SOLO LETRAS
$("#Nomb ").bind('keypress', function(event) {
  var regex = new RegExp("^[a-zA-Z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Solo puedes ingresar letras!!',
      timer: 1500,
      showConfirmButton: false
    })
    return false;
  }
});




//REGISTRAR TAREAS
$('#regi-tarea').submit(function (e) {
  e.preventDefault();
   
   var Nombre = $('#Nombre').val();
   var Descrip = $('#Descrip').val();
   var Prioridad = $('#Prioridad').val();
   var action = 'registrar';

if( Nombre == "" || Descrip == "" || Prioridad == ""){
  Swal.fire({
    icon: 'error',
    title: 'Debes completar los campos!!',
    timer: 2000,
    showConfirmButton: false
  })
}else{
  $.ajax({
    url: '../../app/controladores/Tareas/tareaController.php', 
    method: 'POST',
    async:true,
    data:{action:action, Nombre:Nombre, Descrip:Descrip, Prioridad:Prioridad},

    success: function(response){
      console.log(response);
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
}


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
          console.log(response);
         let tareas = JSON.parse(response);
         let template = '';

         tareas.forEach(tareas => {
            template +=`
            
            <div class="card" id="card" taskId = "${tareas.id} " >
            <div class="card-body " > 
            <div class="form-row d-flex">
               <div class="form-group col-md-6 p-2">
                    <h6>NOMBRE:</h6> 
                    <p> ${tareas.nombre_tarea} 

                    <div id="prioridad"><h6>PRIORIDAD:</h6> ${tareas.prioridad}  </p>
                </div>
                <div class="form-group col-md-6 p-2">
                    <div id="usuario"><h6>USUARIO:</h6> 
                    <p> ${tareas.nombre} </p> </div> 
                      
                </div>
            </div>  
                <div class="form-group col-md-6 p-2">
                    <h6>DESCRIPCIÓN:</h6>          
                    <p> ${tareas.descrip} </p>
                    <div id="usuario"><h6>FECHA:</h6> 
                    <p> ${tareas.fecha} </p> 
                  </div>
                </div>
                </div>
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
                                        <button type="button" class=" elimiTask btn bg-warning" data-bs-dismiss="modal" aria-label="close">Cancelar</button>
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

$(document).on('click','.editar', function(e){
  e.preventDefault();
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
     
      Swal.fire({
           
        icon: 'success',
        title: 'Editado Exítosamente!!',
        showConfirmButton: false,
        timer: 1800
        
      });
    }
  });
  $('#registrar').modal('hide');
  ListarTarea();
})
});

//ELIMINAR TAREAS

$(document).on('click','.eliminar', function(e){
  e.preventDefault();
  
  Swal.fire({
    title: 'Estas seguro?',
    text: "Esta actividad no tiene regreso!",
    icon: 'warning',
    showCancelButton: 'cancelar         ',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!'
}).then((result) => {
  if (result.isConfirmed) {

    let element = $(this)[0].parentElement.parentElement;
    var Id = $(element).attr('taskId');
    var action = 'eliminar';
    $.ajax({
      url:'../../app/controladores/tareas/tareaController.php',
      method: 'POST',
      async:true,
      data:{action:action, Id:Id},
  
      success:function(response){
        ListarTarea();
      }
    })
    Swal.fire({
           
      icon: 'success',
      title: 'Eliminado Exítosamente!!',
      showConfirmButton: false,
      timer: 1800
      
    });
      
  }
});
});

