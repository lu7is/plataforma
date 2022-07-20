
$(document).ready(function(){
    ListarBodega();
    alert('CARLOS');

})

alert('LISTO JAVAS')

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
    var action = "listar";
    tablaBodegas = $('#tablaBodegas').DataTable({
        "language": {

            "lengthMenu": "Mostrar "+ 
                                  `   <select class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value= "10">10</option>
                                        <option value= "25">25</option>
                                        <option value= "50">50</option>
                                        <option value= "100">100</option>
                                        <option value= "-1">Todos</option>
                                    </select> `+
                                    " registros por pagina",
            "zeroRecords": "Registro no encontrado",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ total registros)",
            "search": "Buscar:",
            "paginate":{
                "next":"Siguiente",
                "previous": "Anterior"
            }
        },

        "ajax":{
            "url":'../../app/controladores/Bodegas/registrar.php',
            "method":'POST',
            "data":{action:action},
            "dataSrc":""
        },
        "columns":[
           
            {"data":"id"},
            {"data":"op"},
            {"data":"cantidad"},
            {"data":"recibido"},
            {"data":"faltantes"},
            {"data":"descripcion"},
            {"data":"fecha"},
            {"data":"estado"},
            {"data":"id_cliente"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button  class='btn btn-warning btn-sm btnEditar'><i class='material-icons'>edit</i>Editar</button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i>Eliminar</button></div></div>"}
        ],

    });

}
