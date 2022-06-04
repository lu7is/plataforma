

//REGISTRAR GASTOS
/*
$('#regi-gasto').submit(function(e){

    const datos_post = {
        action  'registrar',
        Fecha: $('#Fecha').val(),
        Concepto: $('#Concepto').val(),
        Valor: $('#valor').val(),
        Proveedor: $('#Proveedor').val(),
        


    };
$.post('../../app/controladores/Gastos/gastosController.php',datos_post,function (response){
    console.log(response);
    $('#regi-gasto').trigger('reset');
    
})

    e.preventDefault();


});
*/
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
                console.log(response);
                $('#regi-gasto').trigger('reset');
            },

            error: function(error){
                alert('no mano ahh ')
            }
        })

    
    
    


    e.preventDefault();


});

