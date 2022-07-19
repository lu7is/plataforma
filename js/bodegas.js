
$('#regi_bode').submit(function (e) {
  

        var Op = $('#Op').val();
        var Cantidad = $('#Cantidad').val();
        var Descrip = $('#Descrip').val();
        var Faltantes = $('#Faltantes').val();
        var Recibido = $('#Recibido').val();
        var Cliente = $('#Cliente').val();
        var action = 'registrar';


    if(Op == "" || Cantidad == "" || Descrip == "" || Cliente == ""){
        Swal.fire({
            icon: 'error',
            title: 'Debes completar los campos!!',
            timer: 2000,
            showConfirmButton: false
          })
    }else{
        $.ajax({
            url:'../../app/controladores/Bodegas/registrar.php',
            method:'POST',
            async:true,
            data:{action:action, Op:Op, Cantidad:Cantidad, Descrip:Descrip, Cliente:Cliente},

        success:function(response){
            console.log(response);
        }
        })
    }
 
    e.preventDefault();
});

$('#Recibido').keyup(function(e){
    e.preventDefault();
    //CALCULAMOS EL VALOR INGRESADO MENOS LO QUE RECIBIO
    var CanTotal = $('#Cantidad').val() -  $(this).val();
    $('#Faltantes').val(CanTotal);
    $('#Faltantes').prop('disabled', 'disabled');
    
})

