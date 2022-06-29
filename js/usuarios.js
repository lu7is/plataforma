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
           
           id= {"data":"id"},
           nombre =  {"data":"nombre"},
            {"data":"apellido"},
            {"data":"telefono"},
            {"data":"direccion"},
            
            {"data":"rol"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-warning btn-sm btnEditar'><i class='material-icons'>edit</i>Editar</button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i>Eliminar</button></div></div>"}
        ]
        
       
    });
  

    
}

//EDITAR LOS USUARIOS
    var fila;

$(document).on('click',".btnEditar", function(){
    fila = $(this).closest("tr");
    Id = parseInt(fila.find('td:eq(0)').text());
    username = fila.find('td:eq(1)').text();
    first_name = fila.find('td:eq(2)').text();
    last_name = fila.find('td:eq(3)').text();
    gender = fila.find('td:eq(4)').text();
    console.log(Id,username,first_name,last_name,gender);
    var action = 'editar';

    $.ajax({
        url:'../../app/controladores/Usuarios/usuariosController.php',
        method:'POST',
        async:true,
        data:{action:action, Id:Id},
        
        success:function(response){
           // const usuarios = JSON.parse(response);
            console.log(response);
        }
    });

    
    
});


