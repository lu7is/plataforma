
//AGREGAR MAS ITENS EN LA FACTURA

var count = $(".itemRow").length;

	
	$(document).on( function() { 
		count++;
		var htmlRows = '';
        
		htmlRows += '<tr>';

		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
		htmlRows += '<td><input type="text" name="productCode[]" id="cantidad'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="productName[]" id="descripcion'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		
		          
		htmlRows += '</tr>';

		$('#invoiceItem').append(htmlRows);
	}); 

//ELIMINAR ITENS DE LA FACTURA

$(document).on('click', '#removeRows', function(){
    $(".itemRow:checked").each(function() {
        $(this).closest('tr').remove();
});
    $('#checkAll').prop('checked', false);
    calculateTotal();
});

//CALCULAR EL TOTAL AL INGRESAR LA CANTIDAD

$('#Precio').keyup(function(e){
    e.preventDefault();

    var precioTotal = $(this).val() * $('#Cantidad').val();
    $('#Monto').val(precioTotal);
    //OCULTAR BOTTON POR VALIDACION
    if($(this).val() < 1 || isNaN($(this).val())){
        $('#addRows').slideUp();
    }else{
        $('#addRows').slideDown();
    }
    
})
//AGREGAR PRODUCTOS AL DETALLE
$('#addRows').click(function(e){
    e.preventDefault();

    if($('#Cantidad').val() > 0){
        
      var  Cantidad = $('#Cantidad').val();
      var  Descripcion = $('#Descripcion').val();
      var  Precio = $('#Precio').val();
      var  Monto = $('#Monto').val();
      var  action = 'factura';

        $.ajax({
            url: '../../app/controladores/Facturas/factProduct.php',
            type: 'POST',
            async:true,
            data:{action:action, Cantidad:Cantidad, Descripcion:Descripcion, Precio:Precio, Monto:Monto},

            success: function(response){
              //  console.log(response);
               // Listar_Temp();
            },
            error: function(error){
                alert('error mano');
            }
        });    
    }
});

//LIATAR LOS DATROS DE LA TABLA TEMPORAL
function Listar_Temp(){
   $.ajax({
       url:'../../app/controladores/Facturas/listar_temp.php',
       type: 'get',
       success:function(response){
           let listado = JSON.parse(response);
           let template = '';

           listado.forEach(listado =>{
                template +=`
                <div si="${listado.cantidad}">   </div> 
                
                ` 
           }); 
           $('#list_temp').html(template);
           console.log(si);
           
       }
   })
    
}







$('#Cliente').change(function(){

    if($('#Cliente').val()){
        let Id = $('#Cliente').val();
        $.ajax({
            url: '../../app/controladores/Facturas/listarOp.php',
            type: 'post',
            data: {Id},
        success: function (response){
            let bode = JSON.parse(response);
            let template = '';
           
           bode.forEach(bode=>{
                
                template +=`
                <div bodekId="${bode.id}">
                 <div cant ="${bode.recibido}">
                <input type="checkbox"  class="valor" > Op: ${bode.op} - Cantidad: ${bode.cantidad} - Recibido: ${bode.recibido} <br>        
                </div>
                </div>
                `
           });
            $('#op').html(template);
           
        }
       
        })
    }
});

$(document).on('click', '.valor',function(){

        if($('.valor').is(':checked')){
          
          let element = $(this)[0].parentElement.parentElement;
          let Id = $(element).attr('bodekId');
            console.log(Id);
          $('#Cantidad').removeAttr('disabled');
          $('#addRows').removeAttr('disabled');
          
        }else{
          console.log("no esta chekeado")
          $('#Cantidad').attr('disabled','disabled');
          $('#addRows').attr('disabled','disabled');
        }
    
});

//optener el valor registrado 
$(document).on('click', '.valor',function(){

    if($('.valor').is(':checked')){
      
    let element = $(this)[0].parentElement;
      var cant0 = parseInt($(element).attr('cant'));
        console.log(cant0);
    }
    $('#Cantidad').keyup(function(e){
        e.preventDefault();
        if( ($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > cant0 ) ){
            $('#addRows').slideUp();
        }else{
            $('#addRows').slideDown();
        }
        
    })

});



























