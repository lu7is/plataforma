
//AGREGAR MAS ITENS EN LA FACTURA

var count = $(".itemRow").length;
	
	$(document).on('click', '#addRows', function() { 
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

$('#precio').keyup(function(e){
    e.preventDefault();

    var precioTotal = $(this).val() * $('#cantidad').val();
    $('#monto').val(precioTotal);
    //OCULTAR BOTTON POR VALIDACION
    if($(this).val() < 1 || isNaN($(this).val())){
        $('#addRows').slideUp();
    }else{
        $('#addRows').slideDown();
    }
    
})



















//inicia el documento cargando todas las funciones
$(document).ready(function() {
    $('').click(function(){
        agregar();
    })
});

var count =0;

function agregar(){
     alert("presion");
    var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
		htmlRows += '<td><input type="text" name="productCode[]" id="cantidad'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="productName[]" id="descripcion'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
		          
		htmlRows += '</tr>';

    $('#invoiceItem').append(htmlRows);
    
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
          $('#cantidad').removeAttr('disabled');
          $('#addRows').removeAttr('disabled');
          
        }else{
          console.log("no esta chekeado")
          $('#cantidad').attr('disabled','disabled');
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
    $('#cantidad').keyup(function(e){
        e.preventDefault();
        if( ($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > cant0 ) ){
            $('#addRows').slideUp();
        }else{
            $('#addRows').slideDown();
        }
        
    })

});



$("#generar_factura").click(function(){



    alert('fue precionado');
//	$.ajax({
	//url: ...,
	//method: ...,

//	})
//	.done(function(res){
	//	console.log(res)
	//})
});
























