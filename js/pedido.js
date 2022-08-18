$(document).ready(function(){
  Listar_Pedidos()
})

//REGISTRAR GASTOS
$('#regi_pedi').submit(function(e){
    Opservacion = $('#Opservacion').val(),
    Descripcion = $('#Descripcion').val(),
    Proveedor = $('#Proveedor').val(),
    action = 'registrar'
    $.ajax({
        url:'../../app/controladores/Pedidos/pedidoController.php',
        method:'POST',
        async:true,
        data:{action:action, Opservacion:Opservacion, Descripcion:Descripcion, Proveedor:Proveedor},
        
        success: function(response){
          tablaPedido.ajax.reload(null, false);
          Swal.fire({
           
            icon: 'success',
            title: 'Registrado Exítosamente!!',
            showConfirmButton: false,
            timer: 1600
            
          })
          $('#registrar').modal('hide');
          $('#regi_pedi').trigger('reset')
        }

    })
e.preventDefault();
});

// LISTAR PEDIDOS

function Listar_Pedidos(){
  var  action = 'listar';
  tablaPedido = $('#tablaPedido').DataTable({
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
          "url":'../../app/controladores/Pedidos/pedidoController.php',
          "method":'POST',
          "data":{action:action},
          "dataSrc":""

      },
      "columns":[
         
          {"data":"id"},
          {"data":"opserva"},
          {"data":"descripcion"},
          {"data":"fecha"},
          {"data":"hora"},
          {"data":"nombre"},
          
          {"defaultContent": "<div class='text-center'><div class='btn-group'><button  class='btn btn-warning btn-sm btnEditar'><i class='material-icons'>edit</i>Editar</button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i>Eliminar</button></div></div>"}
      ]
  });
}
//EDITAR PEDIDOS
$(document).on('click', ".btnEditar", function(e){
  e.preventDefault();
    var action = "editar";
    fila = $(this).closest("tr");
    var Id;
    if($(this).parents("tr").hasClass('child')){ 
         Id = $(this).parents("tr").prev().find('td:eq(0)').text(); 
    } else {
         Id = $(this).closest("tr").find('td:eq(0)').text(); 
    }
    $.ajax({
      url:'../../app/controladores/Pedidos/pedidoController.php',
      method: 'POST',
      async:true,
      data:{action:action, Id:Id},
        success:function(response){
          const pedido = JSON.parse(response);
           $('#id').val(pedido.id);
           $('#opservacion').val(pedido.opserva);
           $('#descripcion').val(pedido.descripcion);
           $('#proveedor').val(pedido.id_prove);
           $('#editar').modal('show');


        }
       
    })


    $('#edi_pedido').submit(function (e){
      e.preventDefault();
      var Id = $('#id').val();
      var Opservacion = $('#opservacion').val();
      var Descripcion = $('#descripcion').val();
      var Proveedor = $('#proveedor').val();
      var action = "actualizar";

      $.ajax({
        url:'../../app/controladores/Pedidos/pedidoController.php',
        method: 'POST',
        async:true,
        data:{action:action,Id:Id, Opservacion:Opservacion, Descripcion:Descripcion, Proveedor:Proveedor},
        success:function(response){
          tablaPedido.ajax.reload(null, false);
          console.log(response);
          Swal.fire({
            icon: 'success',
            title: 'Editado Exítosamente!!',
            showConfirmButton: false,
            timer: 1800
            
          });
        }
      });
      $('#editar').modal('hide');

    })


})
//ELIMINAR PEDIDO
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
        url:'../../app/controladores/Pedidos/pedidoController.php',
        method: 'POST',
        async:true,
        data:{action:action, Id:Id,},

        success: function(response){
          tablaPedido.ajax.reload(null, false);
          console.log(response);
        }
       })
       Swal.fire({ 
        icon: 'success',
        title: 'Eliminado Exítosamente!!',
        showConfirmButton: false,
        timer: 1600
})

    }
});
  

})

