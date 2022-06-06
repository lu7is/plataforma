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
                
                window.location.replace("principal.php");  
            },
            error: function(error){
                alert('Error al realizar el registro, por favor intentar nuevamente')
            }

        })
    e.preventDefault();
});
alert("si claro mano")

//LISTAR GASTOS

function Listar_gastos(){
    $.ajax({
      url:'../../app/controladores/Gastos/listar.php',
      method:'GET',
      success: function(response){
        let gasto = JSON.parse(response);
        let template = '';
        gasto.forEach(gasto => {
          template +=` 
                <h1> casi que no </h1>
          ` 
        });
        $('#listar_gasto').html(template);


      }

    })
      
    
}










