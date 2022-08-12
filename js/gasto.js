$(document).ready(function(){
  Listar_gastos()
})

//REGISTRAR GASTOS
$('#regi-gasto').submit(function(e){
        Concepto = $('#Concepto').val(),
        Valor = $('#Valor').val(),
        Proveedor = $('#Proveedor').val(),
        action = 'registrar'
        $.ajax({
            url:'../../app/controladores/Gastos/gastosController.php',
            method:'POST',
            async:true,
            data:{action:action, Concepto:Concepto, Valor:Valor, Proveedor:Proveedor},
            
            success: function(response){
              tablaGasto.ajax.reload(null, false);
              Swal.fire({
               
                icon: 'success',
                title: 'Registrado Exítosamente!!',
                showConfirmButton: false,
                timer: 1600
                
              })
              $('#modal_registrar').modal('hide');
              $('#regi-gasto').trigger('reset')
            }

        })
    e.preventDefault();
});



//LISTAR GASTOS

function Listar_gastos(){
   var action = 'listar'
   tablaGasto = $('#tablaGasto').DataTable({
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
    "url":'../../app/controladores/Gastos/gastosController.php',
    "method":'POST',
    "data":{action:action},
    "dataSrc":""

},
"columns":[
           
  {"data":"id"},
  {"data":"fecha"},
  {"data":"concepto"},
  {"data":"valor"},
  {"data":"nombre"},
  {"defaultContent": "<div class='text-center'><div class='btn-group'><button  class='btn btn-warning btn-sm btnEditar'><i class='material-icons'>edit</i>Editar</button> <button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i>Eliminar</button></div></div>"}
]

   });
      
    
}
//EDITAR LOS GASTOS

$(document).on('click', ".btnEditar", function(e){
  e.preventDefault();
  fila = $(this).closest("tr");
  Id = parseInt(fila.find('td:eq(0)').text());
  Concepto = fila.find('td:eq(2)').text();
  Valor = fila.find('td:eq(3)').text();
  Proveedor = fila.find('td:eq(4)').text();

  $('#id').val(Id);
  $('#concepto').val(Concepto);
  $('#valor').val(Valor);
  $('#proveedor').val(nombre);
  $('#modal_editar').modal('show');


$('#edit-gasto').submit(function(e){
  e.preventDefault();
  var Id = $('#id').val();
  var Concepto = $('#concepto').val();
  var Valor = $('#valor').val();
  var Proveedor = $('#proveedor').val();
  var action = 'actualizar';

  $.ajax({
    url: '../../app/controladores/Gastos/gastosController.php',
    method: 'POST',
    async:true,
    data:{action:action,Id:Id, Concepto:Concepto, Valor:Valor, Proveedor:Proveedor},

  success: function(response){
    tablaGasto.ajax.reload(null, false);
    Swal.fire({
               
      icon: 'success',
      title: 'Editado Exítosamente!!',
      showConfirmButton: false,
      timer: 1600
      
    })
    $('#modal_editar').modal('hide');
    $('#edit-gasto').trigger('reset')
  }
  });

})
});
//ELIMINAR GASTOS
$(document).on('click', '.btnBorrar', function(e){
    e.preventDefault();
    fila = $(this).closest("tr");
    var Id = parseInt(fila.find('td:eq(0)').text());
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
          url:'../../app/controladores/Gastos/gastosController.php',
          method: 'POST',
          async:true,
          data:{action:action, Id:Id,},

          success: function(response){
            tablaGasto.ajax.reload(null, false);
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









