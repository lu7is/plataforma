//REGISTRAR GASTOS
$('#regi-gasto').submit(function(e){
        Fecha = $('#Fecha').val(),
        Concepto = $('#Concepto').val(),
        Valor = $('#Valor').val(),
        Proveedor = $('#Proveedor').val(),
        action = 'registrar'
        $.ajax({
            url:'../../app/controladores/Gastos/gastosController.php',
            method:'POST',
            async:true,
            data:{action:action, Fecha:Fecha, Concepto:Concepto, Valor:Valor, Proveedor:Proveedor},
            
            success: function(response){
                
              Swal.fire({
           
                icon: 'success',
                title: 'Registrado Exítosamente!!',
                showConfirmButton: true,
                
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace("principal.php"); 
                }
            }) 
            },
            error: function(error){
                alert('Error al realizar el registro, por favor intentar nuevamente')
            }

        })
    e.preventDefault();
});

$(document).ready(function(){
  Listar_gastos()
})

//LISTAR GASTOS

function Listar_gastos(){
   var action = 'listar'
    $.ajax({
      url:'../../app/controladores/Gastos/gastosController.php',
      method:'POST',
      async:true,
      data:{action:action},
      success: function(response){
       
       let gasto = JSON.parse(response);
        let template = '';
        gasto.forEach(gasto => {
          template +=` 
                <h1>${gasto.fecha} casi que no </h1>
          ` 
        });
        $('#listar_gasto').html(template);


      }

    })
      
    
}










