
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
                
                
                <input type="checkbox" > ${bode.op}-${bode.cantidad} <br>        
                            
               
                 
               
               



               
                 `
                
           });
            
            
         
            $('#op').html(template);
        }

        })
        
    }
       
        
});

























