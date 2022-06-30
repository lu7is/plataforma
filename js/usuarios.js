//APENAS LA PAGINA CARGUE LLAMA A LAS FUNCIONES REGISTRADAS
$(document).ready(function(){
    Listar_Usuarios();
})

//REGISTRAR USUARIOS 
$('#form-usu').submit(function (e) {
    
     var Cedula = ('#Cedula').val();
     var Nombre = ('#Nombre').val();
     var Apellido = ('#Apellido').val();
     var Telefono = ('#Telefono').val();
     var Direccion = ('#Direccion').val();
     var Correo = ('#Correo').val();
     var Password = ('#Password').val();
     var Rol = ('#Rol').val();
     var action = 'registrar';

     $.ajax({
        url:'../../app/controladores/Usuarios/usuariosController.php',
        method:'POST',
        async:true,
        data:{action:action, Cedula:Cedula, Nombre:Nombre, Apellido:Apellido, Telefono:Telefono, Direccion:Direccion, 
              Correo:Correo, Password:Password, Rol:Rol},
        success:function(response){

        }
     });

});  

//LISTAR USUARIOS REGISTRADOS

function Listar_Usuarios(){
    var  action = 'listar';
    var id, nombre;


    tablaUsuarios = $('#tablaUsuarios').DataTable({
        "ajax":{
            "url":'../../app/controladores/Usuarios/usuariosController.php',
            "method":'POST',
            "data":{action:action},
            "dataSrc":""

        },
        "columns":[
           
            {"data":"id"},
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
    var fila;

$(document).on('click',".btnEditar", function(){
    fila = $(this).closest("tr");
    Id = parseInt(fila.find('td:eq(0)').text());
    Cedula = fila.find('td:eq(1)').text();
    Nombre = fila.find('td:eq(2)').text();
    Apellido = fila.find('td:eq(3)').text();
    Telefono = fila.find('td:eq(4)').text();
    Direccion = fila.find('td:eq(5)').text();
    Correo = fila.find('td:eq(6)').text();
    Rol = fila.find('td:eq(7)').text();
    
    var action = 'editar';
    
    $('#Cedula').val(Cedula);
    $('#Nombre').val(Nombre);
    $('#Apellido').val(Apellido);
    $('#Telefono').val(Telefono);
    $('#Direccion').val(Direccion);
    $('#Correo').val(Correo);
    $('#Rol').val(Rol);
    $('#Password').attr('disabled','disabled');
    $('#registrar').modal('show');

    
    
});


