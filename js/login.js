$(document).ready(function(){
   
})

//LOGIN DE USUARIOS

$('#form_login').submit(function(e){
    e.preventDefault();
    var Correo = $('#inputEmail').val();
    var Password = $('#inputPassword').val();
    
    if(Correo == "" || Password ==""){
        Swal.fire({
            icon: 'error',
            title: 'Debes completar los campos!!',
            timer: 2000,
            showConfirmButton: false
          })
    }else{
        $.ajax({
            url:'../../app/controladores/loginController.php',
            method:'POST',
            async:true,
            data:{Correo:Correo, Password:Password},
    
            beforeSend: function(){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                   
                  })
                  
                  Toast.fire({
                    icon: 'success',
                    title: 'Sesión iniciada corractamente'
                  })
            },
            success:function (response){
                window.location.replace("../dashboard.php"); 
                console.log(response)
               
            },
            error:function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error inesperado!',
                    showConfirmButton: false
                  })
            },
            complete: function(jqXHR,estado){
                console.log(estado)
            },
            timeout: 10000
    
        })
    }
    
    

})