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
                
              Swal.fire({
           
                icon: 'success',
                title: 'Registrado Exítosamente!!',
                showConfirmButton: true,
                
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace("principal.php"); 
                }
            }) 
            },
            error: function(error){
                alert('Error al realizar el registro, por favor intentar nuevamente')
            }

        })
    e.preventDefault();
});

$(document).ready(function(){
  Listar_gastos()
})

//LISTAR GASTOS

function Listar_gastos(){
   var action = 'listar'
    $.ajax({
      url:'../../app/controladores/Gastos/gastosController.php',
      method:'POST',
      async:true,
      data:{action:action},
      success: function(response){
       
       let gasto = JSON.parse(response);
        let template = '';
        gasto.forEach(gasto => {
          template +=` 
          <table class="table table-striped">
          <thead >
            <tr>
              
             
              
              <th scope="col">Fecha</th>
              <th scope="col">Concepto</th>
              <th scope="col">Valor</th>
              <th scope="col">Proveedor</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
            <tbody>
              <tr>
                
                
                <td>${gasto.fecha}</td>
                <td>${gasto.concepto}</td>
                <td>${gasto.valor}</td>
                <td>${gasto.proveedor}</td>
                
                <td>
               
                <a href=""><button type="button" class= "btn btn-warning">Editar</button></a>
                <a href=""><button type="button" class= "btn btn-danger" >Eliminar</button></a>
                <button type="submit" class= "btn btn-primary"  >Ver</button>   


                
              </td>
                
              </tr>
            </tbody>
    
    
 
          </table>

          ` 
        });
        $('#listar_gasto').html(template);


      }

    })
      
    
}










