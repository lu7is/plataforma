$(document).ready(function(){
    
})

//REGISTRAR BODEGAS
$('#regi_bode').submit(function (e) {
  

        var Op = $('#Op').val();
        var Cantidad = $('#Cantidad').val();
        var Recibido = $('#Recibido').val();
        var Faltantes = $('#Faltantes').val();
        var Descrip = $('#Descrip').val();
        var Cliente = $('#Cliente').val();
        var action = 'registrar';


    if(Op == "" || Cantidad == "" || Descrip == "" || Faltantes == "" || Recibido == "" || Cliente == ""){
        Swal.fire({
            icon: 'error',
            title: 'Debes completar los campos!!',
            timer: 2000,
            showConfirmButton: false
          })
    }else{
        //console.log(Op,Cantidad,Descrip,Faltantes,Recibido,Cliente,action);
        $.ajax({
            url:'../../app/controladores/Bodegas/registrar.php',
            method:'POST',
            async:true,
            data:{action:action, Op:Op, Cantidad:Cantidad, Recibido:Recibido, Faltantes:Faltantes, Descrip:Descrip, Cliente:Cliente},

        success:function(response){
            console.log(response);
            $('#registrar').modal('hide');
        }
        })
    }
    
    e.preventDefault();
});
//CALCULA LO ENVIADO SOBRE LO RECIBIDO
$('#Recibido').keyup(function(e){
    e.preventDefault();
    //CALCULAMOS EL VALOR INGRESADO MENOS LO QUE RECIBIO
    var CanTotal = $('#Cantidad').val() -  $(this).val();
    $('#Faltantes').val(CanTotal);
   
})

//LISTAR TODAS LAS MERCANCIAS 
function ListarBodega(){

}
