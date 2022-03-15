
$('#regi_bode').submit(function (e) {
    const datos = {
        Op:$('#Op').val(),
        Cantidad:$('#Cantidad').val(),
        Descrip:$('#Descrip').val(),
        Fecha:$('#Fecha').val(),
        Cliente:$('#Cliente').val()
    };
   
    $.post('../../app/controladores/Bodegas/registrar.php', datos, function(response){
        Swal.fire(

                'Muy Bien!',
                'registrado!',
                'success',
            
        ).then((result) => {
            if (result.isConfirmed) {
                $('#regi_bode').trigger('reset');
                window.location.replace("principal.php");
            }
        });
       
    });
    e.preventDefault();
});



