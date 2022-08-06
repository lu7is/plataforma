//APENAS LA PAGINA CARGUE LLAMA A LAS FUNCIONES REGISTRADAS
$(document).ready(function(){
    Listar_Usuarios();

  
})

if ($('#Cedula').val().length != 1 || isNaN($('#Cedula').val())) {
    $('#Cedula').css('border-color','#FF0000');
    alert('El número de teléfono debe tener al menos 9 números.');

}
else {
    alert('OK');
}














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
                    
                  }).then((result) => {
                    if (result.isConfirmed) {
                        
                        tablaUsuarios.ajax.reload(null, false);
                        $('#registrar').modal('hide');
                        $('#form-usu').trigger('reset')
                    }
                })
            }
            
         });
    }

});  

//LISTAR USUARIOS REGISTRADOS
function Listar_Usuarios(){
    var  action = 'listar';
    tablaUsuarios = $('#tablaUsuarios').DataTable({
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

//EDITAR LOS USUARIOS
$(document).on('click', ".btnEditar", function(e){
    e.preventDefault();
    fila = $(this).closest("tr");
    Id = parseInt(fila.find('td:eq(0)').text());
    Cedula = fila.find('td:eq(1)').text();
    Nombre = fila.find('td:eq(2)').text();
    Apellido = fila.find('td:eq(3)').text();
    Telefono = fila.find('td:eq(4)').text();
    Direccion = fila.find('td:eq(5)').text();
    Correo = fila.find('td:eq(6)').text();
    Rol = fila.find('td:eq(7)').text();

    $('#id').val(Id);
    $('#cedula').val(Cedula);
    $('#nombre').val(Nombre);
    $('#apellido').val(Apellido);
    $('#telefono').val(Telefono);
    $('#direccion').val(Direccion);
    $('#correo').val(Correo);
    $('#rol').val(Rol);
    $('#editar').modal('show');

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
  var  Id = parseInt(fila.find('td:eq(0)').text());
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
//VALIDACIONES




