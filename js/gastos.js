

//REGISTRAR GASTOS

$('#regi-gasto').submit(function(e){

    const datos_post = {
        Fecha: $('#Fecha').val(),
        Concepto: $('#Concepto').val(),
        Valor: $('#valor').val(),
        Proveedor: $('#Proveedor').val(),


    };
console.log(datos_post);
    e.preventDefault();

});

