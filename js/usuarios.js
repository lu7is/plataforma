//APENAS LA PAGINA CARGUE LLAMA A LAS FUNCIONES REGISTRADAS
$(document).ready(function(){
    Listar_Usuarios();
//validacion para formulario registrar
    $('#form-usu').validate({
        rules:{
            Cedula:{
                required:true,
                minlength: 8,
                maxlength: 10
            },
            Nombre:{
                required:true,
                minlength: 3,
                maxlength: 20
            },
            Apellido:{
                required:true,
                minlength: 3,
                maxlength: 20
            },
            Telefono:{
                required:true,
                maxlength: 10
            },
            Direccion:{
                required:true,
                minlength: 3,
                maxlength: 20
            },
            Correo:{
                required:true,
                maxlength: 20,
                email:true
            },
            Password:{
                required:true,
                minlength: 5,
                maxlength: 10

            },
            Rol:{
                required:true,
            }


        },

        messages: {  
            Cedula: {
                required: "Por favor ingresa tu cedula completo",
                minlength: "Tu cedula debe ser de no menos de 5 caracteres",
                maxlength: "Tu cedula no debe ser de mas de 10 caracteres",
                number: "Solo caracteres numericos"
             },         
            Nombre: {
               required: "Por favor ingresa tu nombre ",
               minlength: "Tu nombre debe ser de no menos de 3 caracteres",
               maxlength: "Tu nombre no debe ser de mas de 20 caracteres"
            },
            Apellido: {
                required: "Por favor ingresa tu apellido ",
                minlength: "Tu apellido debe ser de no menos de 3 caracteres",
                maxlength: "Tu apellido no debe ser de mas de 10 caracteres"
            },
            Telefono:{
                required: "Por favor ingresa tu telefono ",
                maxlength: "Tu Telefono no debe ser de mas de 10 caracteres",
                minlength: "Tu cedula debe ser de no menos de 20 caracteres",
                number: "Solo caracteres numericos"
            },
            Direccion:{
                required: "Por favor ingresa tu direccion ",
                minlength: "Tu direccion debe ser de no menos de 3 caracteres",
                maxlength: "Tu direccion no debe ser de mas de 10 caracteres"
            },
            Correo:{
                required: "Por favor ingresa tu correo ",
                email: "Por favor ingresa un correo válido",
            },
            Password: {
               required: "Por favor ingresa una contraseña",
               minlength: "Tu contraseña debe ser de no menos de 5 caracteres de longitud"
            },
            Rol:{
                required:"Selecciona un rol"
            }
        },
       


        
      
           
            
    });
    
})

//VALIDANDO DOLO CAMPOS DE LETRAS 
$("#Nombre,#Apellido ").bind('keypress', function(event) {
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
//REGISTRAR USUARIOS 
$('#form-usu').submit(function (e) {
    e.preventDefault()
     var Cedula = $('#Cedula').val();
     var Nombre = $('#Nombre').val();
     var Apellido = $('#Apellido').val();
     var Telefono = $('#Telefono').val();
     var Direccion = $('#Direccion').val();
     var Correo = $('#Correo').val();
     var Password = $('#Password').val();
     var Rol = $('#Rol').val();
     var action = 'registrar';

     if(Cedula == "" || Cedula < 3   || Nombre == "" || Apellido == "" ||Telefono == "" || Direccion == "" || Correo == "" || Password == "" || Rol ==""){
        Swal.fire({
            icon: 'error',
            title: 'Debes completar los campos!!',
            timer: 2000,
            showConfirmButton: false
          })
    }else{
        $.ajax({
            url:'../../app/controladores/Usuarios/usuariosController.php',
            method:'POST',
            async:true,
            data:{action:action, Cedula:Cedula, Nombre:Nombre, Apellido:Apellido, Telefono:Telefono, Direccion:Direccion, 
                  Correo:Correo, Password:Password, Rol:Rol},
            success:function(response){
                tablaUsuarios.ajax.reload(null, false);
                Swal.fire({
               
                    icon: 'success',
                    title: 'Registrado Exítosamente!!',
                    showConfirmButton: false,
                    timer: 1500
                    
                  }) 
                        tablaUsuarios.ajax.reload(null, false);
                        $('#registrar').modal('hide');
                        $('#form-usu').trigger('reset')
                 
            }
            
         });
    }
   // $('#registrar').modal('hide');
    $('#form-usu').trigger('reset')
    $('#form-usu').removeClass()
       
   

});  

//LISTAR USUARIOS REGISTRADOS
function Listar_Usuarios(){
    var  action = 'listar';
    tablaUsuarios = $('#tablaUsuarios').DataTable({
        responsive: true,
        "language": {

            "lengthMenu": "Mostrar "+ 
                                  `   <select class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value= "10">10</option>
                                        <option value= "25">25</option>
                                        <option value= "50">50</option>
                                        <option value= "100">100</option>
                                        <option value= "-1">Todos</option>
                                    </select> `+
                                    " registros por pagina",
            "zeroRecords": "Registro no encontrado",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ total registros)",
            "search": "Buscar:",
            "paginate":{
                "next":"Siguiente",
                "previous": "Anterior"
            }
        },
        "ajax":{
            "url":'../../app/controladores/Usuarios/usuariosController.php',
            "method":'POST',
            "data":{action:action},
            "dataSrc":""

        },
        "columns":[
           
            {"data":"id_usuario"},
            {"data":"cedula"},
            {"data":"nombre"},
            {"data":"apellido"},
            {"data":"telefono"},
            {"data":"direccion"},
            {"data":"correo"},
            {"data":"rol"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button  class='btn btn-warning btn-sm btnEditar'><i class='material-icons'>edit</i>Editar</button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i>Eliminar</button></div></div>"}
        ]
    });
}
//VALIDANDO DOLO CAMPOS DE LETRAS 
$("#nombre,#apellido ").bind('keypress', function(event) {
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

//EDITAR LOS USUARIOS
$(document).on('click', ".btnEditar", function(e){
    e.preventDefault();
    var action ="listar_Id";
    var Id;
    if($(this).parents("tr").hasClass('child')){ 
         Id = $(this).parents("tr").prev().find('td:eq(0)').text(); 
    } else {
         Id = $(this).closest("tr").find('td:eq(0)').text(); 
    }

    
    $.ajax({
        url:'../../app/controladores/Usuarios/usuariosController.php',
        method:'POST',
        async:true,
        data:{action:action, Id:Id},
        success:function(response){
          
           const usuarios = JSON.parse(response);

            $('#id').val(usuarios.id_usuario);
            $('#cedula').val(usuarios.cedula);
            $('#nombre').val(usuarios.nombre);
            $('#apellido').val(usuarios.apellido);
            $('#telefono').val(usuarios.telefono);
            $('#direccion').val(usuarios.direccion);
            $('#correo').val(usuarios.correo);
            $('#rol').val(usuarios.rol);
            $('#editar').modal('show');
        }
   }); 

    $('#form_Edit').submit(function(e){
        e.preventDefault();
        var Id = $('#id').val();
        var Cedula = $('#cedula').val();
        var Nombre = $('#nombre').val();
        var Apellido = $('#apellido').val();
        var Telefono = $('#telefono').val();
        var Direccion = $('#direccion').val();
        var Correo = $('#correo').val();
        var Rol = $('#rol').val();
        var action = 'editar';

        $.ajax({
            url:'../../app/controladores/Usuarios/usuariosController.php',
            method:'POST',
            async:true,
            data:{action:action, Id:Id, Cedula:Cedula, Nombre:Nombre, Apellido:Apellido, Telefono:Telefono, Direccion:Direccion,
                  Correo:Correo, Rol:Rol },
            success: function(response){
                tablaUsuarios.ajax.reload(null, false);
                Swal.fire({ 
                    icon: 'success',
                    title: 'Editado Exítosamente!!',
                    showConfirmButton: false,
                    timer: 1500
            })
            }

        });
        $('#editar').modal('hide');  
    })
   
})

// ELIMINAR USUARIOS
$(document).on('click', '.btnBorrar', function(e){
    e.preventDefault();
    fila = $(this).closest("tr");
    var Id;
    if($(this).parents("tr").hasClass('child')){ 
         Id = $(this).parents("tr").prev().find('td:eq(0)').text(); 
    } else {
         Id = $(this).closest("tr").find('td:eq(0)').text(); 
    }
    Swal.fire({
        title: 'Estas seguro?',
        text: "Esta actividad no tiene regreso!",
        icon: 'warning',
        showCancelButton: 'cancelar         ',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if(result.isConfirmed){
           var action = 'eliminar';
           $.ajax({
            url:'../../app/controladores/Usuarios/usuariosController.php',
            method: 'POST',
            async:true,
            data:{action:action, Id:Id,},

            success: function(response){
                tablaUsuarios.ajax.reload(null, false);
            }
           })
           Swal.fire({ 
            icon: 'success',
            title: 'Eliminado Exítosamente!!',
            showConfirmButton: false,
            timer: 1500
    })

        }
    });

})

$('#cancelar').on('click', function(e){
    $('#form-usu').trigger('reset')
    $('#form-usu').removeClass()
    $('#form-usu').reset();
})




