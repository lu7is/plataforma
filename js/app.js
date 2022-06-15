


$(document).ready(function () {
    $('#resultado').hide();
    ListarTareas();
    $('#Nombre').keyup(function (e) {
        if ($('#Nombre').val()) {
            let Nombre = $('#Nombre').val();
            $.ajax({
                url: '../../app/controladores/tareaBuscarController.php',
                type: 'POST',
                data: { Nombre },
                success: function (response) {
                    let datos = JSON.parse(response);
                    let template = '';

                    datos.forEach(datos => {
                        template += ` <li> ${datos.nombre} </li>`
                    });
                    $('#container').html(template);
                    $('#resultado').show();
                }
            });
        }
    });











function ListarTareas() {
     $.ajax({

    url: '../../app/controladores/Tareas/listarTareas.php',
    type: 'GET',
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
                $('#lista').html(template);
            }

        });
    }



//EDITAR TAREAS 
    $(document).on('click', '.editar', function () {
     
        let element = $(this)[0].parentElement.parentElement;
        let Id = $(element).attr('taskId');

        $.post('../../app/controladores/tareas/editarTarea.php', { Id }, function (response) {
            
        const tarea = JSON.parse(response);
        
        $('#Nonbre').val(tarea.nombre);
        $('#Descrip').val(tarea.descrip);
        $('#Prioridad').val(tarea.prioridad);
        $('#Estado').val(tarea.estado);
        $('#taskId').val(tarea.id)
        
        $('#registrar_modal').submit(function (e) {
            const tarea = {
                
                Nonbre: $('#Nonbre').val(),
                Descrip: $('#Descrip').val(),
                Prioridad: $('#Prioridad').val(),
                Estado: $('#Estado').val(),
                Id: $('#taskId').val(),
                  
            };
    
            $.post('../../app/controladores/tareas/actualizarTarea.php', tarea, function (response) {
                Swal.fire({
                    title: 'Informacion editada?',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Continuar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(response);
                        $('#regi-tarea').trigger('reset');
                        window.location.replace("tareas.php");
                    }
                });
                
            })
            e.preventDefault();
           
       });
        });
    });

    $(document).on('click', '.eliminar', function () {

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
                let Id = $(element).attr('taskId');
                $.post('../../app/controladores/tareas/eliminarTarea.php', { Id }, function (response) {
                    ListarTareas();
                });
                Swal.fire(
                    'Eliminado!',
                    'Tarea eliminada exitosamente.',
                    'success'
                )
            }
        })


    })
