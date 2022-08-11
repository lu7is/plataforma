$(document).ready(function(){
    
})

//REGISTRAR GASTOS
$('#regi-gasto').submit(function(e){
    Opservacion = $('#Opservacion').val(),
    Descripcion = $('#Descripcion').val(),
    Proveedor = $('#Proveedor').val(),
    action = 'registrar'
    $.ajax({
        url:'../../app/controladores/Gastos/gastosController.php',
        method:'POST',
        async:true,
        data:{action:action, Concepto:Concepto, Valor:Valor, Proveedor:Proveedor},
        
        success: function(response){
          tablaGasto.ajax.reload(null, false);
          Swal.fire({
           
            icon: 'success',
            title: 'Registrado Exítosamente!!',
            showConfirmButton: false,
            timer: 1600
            
          })
          $('#modal_registrar').modal('hide');
          $('#regi-gasto').trigger('reset')
        }

    })
e.preventDefault();
});