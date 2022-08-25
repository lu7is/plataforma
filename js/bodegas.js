
$(document).ready(function(){
   ListarBodega();
   // alert('CARLOS');

})



//REGISTRAR BODEGAS
$('#regi_bode').submit(function (e) {
  

        var Op = $('#Op').val();
        var Cantidad = $('#Cantidad').val();
        var Recibido = $('#Recibido').val();
        var Faltantes = $('#Faltantes').val();
        var Descrip = $('#Descrip').val();
        var Condicion = $('#Condicion').val();
        var Cliente = $('#Cliente').val();
        var action = 'registrar';


    if(Op == "" || Cantidad == "" || Condicion == "" ||Descrip == "" || Faltantes == "" || Recibido == "" || Cliente == ""){
        Swal.fire({
            icon: 'error',
            title: 'Debes completar los campos!!',
            timer: 2000,
            showConfirmButton: false
          })
    }else{
       // console.log(Op,Cantidad,Descrip,Faltantes,Recibido,Cliente,action);
        $.ajax({
            url:'../../app/controladores/Bodegas/registrar.php',
            method:'POST',
            async:true,
            data:{action:action, Op:Op, Cantidad:Cantidad, Recibido:Recibido, Faltantes:Faltantes, Descrip:Descrip, Condicion:Condicion, Cliente:Cliente},

        success:function(response){
            Bodega.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Registrado Exítosamente!!',
                showConfirmButton: false,
                timer: 1500
                
              })
            Bodega.ajax.reload(null, false);
            $('#registrar').modal('hide');
            $('#regi_bode').trigger('reset')
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

    Bodega = $('#Bodega').DataTable({
        responsive: true,
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
            {"data":"condicion"},
            {"data":"nombre"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button  class='btn btn-warning btn-sm btnEditar'><i class='material-icons'>edit</i>Editar</button><button class='btn btn-danger btn-sm btnBorrar'> <?php if($rol == 'administrador' || $rol == 'supervisor' ) { ?><i class='material-icons'>delete</i>Eliminar</button> <?php }?></div></div>"}
        ]
    });

}

//EDITAR LAS BODEGAS REGISTRADAS
var fila;
$(document).on('click', ".btnEditar", function(e){
    e.preventDefault();
   var action ="editar";
   var Id;
   if($(this).parents("tr").hasClass('child')){ 
        Id = $(this).parents("tr").prev().find('td:eq(0)').text(); 
   } else {
        Id = $(this).closest("tr").find('td:eq(0)').text(); 
   }
   $.ajax({
        url:'../../app/controladores/Bodegas/registrar.php',
        method:'POST',
        async:true,
        data:{action:action, Id:Id},
        success:function(response){
            
            const bodega = JSON.parse(response);
            $('#id').val(bodega.id);
            $('#op').val(bodega.op);
            $('#cantidad').val(bodega.cantidad);
            $('#recibido').val(bodega.recibido);
            $('#faltantes').val(bodega.faltantes);
            $('#descrip').val(bodega.descripcion);
            $('#condicion').val(bodega.condicion);
            $('#cliente_edit').val(bodega.id_cliente);
            
        }
   }); 

$('#edi_bode').submit(function(e){
    e.preventDefault();
    var Id = $('#id').val();
    var Op = $('#op').val();
    var Cantidad = $('#cantidad').val();
    var Recibido = $('#recibido').val();
    var Faltantes = $('#faltantes').val();
    var Descrip = $('#descrip').val();
    var Condicion = $('#condicion').val();
    var Id_client = $('#cliente_edit').val();
    var action = 'actualizar';
    $.ajax({
        url:'../../app/controladores/Bodegas/registrar.php',
        method:'POST',
        async:true,
        data:{action:action, Id:Id, Op:Op, Cantidad:Cantidad, Recibido:Recibido, Faltantes:Faltantes, Descrip:Descrip, Condicion:Condicion, Id_client:Id_client},
        success:function(response){
            Bodega.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Editado Exítosamente!!',
                showConfirmButton: false,
                timer: 1800
                
              });
              Bodega.ajax.reload(null, false);
        }
        
    });
    $('#editar').modal('hide'); 
});  
    
});
//CALCULA LO ENVIADO SOBRE LO RECIBIDO
$('#recibido').keyup(function(e){
    e.preventDefault();
    //CALCULAMOS EL VALOR INGRESADO MENOS LO QUE RECIBIO
    var CanTotal = $('#cantidad').val() -  $(this).val();
    $('#faltantes').val(CanTotal); 
})
//VALIDACION DE CAMPÓS AL INGRESAR CANTIDADES
$('#Recibido').keyup(function(e){
    e.preventDefault();
   // let element = $(this)[0].parentElement;
   // var cant0 = parseInt($(element).attr('cant'));
   //var cant0 = $(this).val();
   var recibido = $('#Recibido').val();
   var cantidad =  $('#Cantidad').val();
    console.log(cantidad, recibido);

    if(recibido < cantidad){
      //  alert('marica no se jajaj')
    }else{
      //  alert('aca estoy')
    }
});


//ELIMINAR 
$(document).on('click', '.btnBorrar', function(e){
    e.preventDefault();
    fila = $(this).closest("tr");
    var Id;
    if($(this).parents("tr").hasClass('child')){ 
         Id = $(this).parents("tr").prev().find('td:eq(0)').text(); 
    } else {
         Id = $(this).closest("tr").find('td:eq(0)').text(); 
    }
    Swal.fire({
        title: 'Estas seguro?',
        text: "Esta actividad no tiene regreso!",
        icon: 'warning',
        showCancelButton: 'cancelar         ',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if(result.isConfirmed){
           var action = 'eliminar';
           $.ajax({
            url:'../../app/controladores/Bodegas/registrar.php',
            method: 'POST',
            async:true,
            data:{action:action, Id:Id,},

            success: function(response){
                Bodega.ajax.reload(null, false);
                console.log(response);
            }
           })
           Swal.fire({ 
            icon: 'success',
            title: 'Eliminado Exítosamente!!',
            showConfirmButton: false,
            timer: 1500
    })

        }
    });

})

$('#cancelar').on('click', function(e){
    $('#form-usu').trigger('reset')
    $('#form-usu').removeClass()
    $('#form-usu').reset();
})
