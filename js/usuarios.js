
$('#form-usu').submit(function (e) {
    const datos_post = {
        Cedula: $('#Cedula').val(),
        Nombre: $('#Nombre').val(),
        Apellido: $('#Apellido').val(),
        Telefono: $('#Telefono').val(),
        Direccion: $('#Direccion').val(),
        Correo: $('#Correo').val(),
        Password: $('#Password').val(),
        Rol: $('#Rol').val(),
    };
    $.post('../../app/controladores/Usuarios/usuariosController.php', datos_post, function (response) {

        
        $(location).attr('href',"../../vistas/usuarios/principal.php");
    });
    e.preventDefault();
});

