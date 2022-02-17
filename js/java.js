function Validacion() {
 var Cedula=$("#Cedula").val();
 var Nombre = $("#Nombre").val();
 var Apellido = $("#Apellido").val();
 var Telefono = $("#Telefono").val();
 var Direccion = $("#Direccion").val();
 var Correo = $("#Correo").val();
 var Password = $("#Password").val();
 var Rol = $("#Rol").val();

 var datos = "Cedula="+ Cedula+
             "&Nombre="+ Nombre +
             "&Apellido="+ Apellido+
             "&Telefono="+Telefono+
             "&Direccion"+ Direccion+
             "&Correo="+Correo+
             "&Password="+Password+
             "&Rol="+Rol;
  $.ajax({
    method: "POST",
    url:"../app/controladores/usuariosController.php",
    data: datos,
  })
  .done(function(msg){
    alert("Datos guardados:"+msg);
  })

}















function AlertaEliminar( ){
    Swal.fire({
        title: 'Estas seguro de eliminar!',
        text: "No se volvera a ver ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El usuario fue eliminado correctamente.',
            'success'
          )
        }
      })
}