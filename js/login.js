$(document).ready(function(){
   
})

//LOGIN DE USUARIOS

$('#form_login').submit(function(e){
    e.preventDefault();
    var Correo = $('#inputEmail').val();
    var Password = $('#inputPassword').val();
    var action = 'login';

    $.ajax({
        url:'../../app/controladores/loginController.php',
        method:'POST',
        async:true,
        data:{action:action,Correo:Correo, Password:Password},
        beforeSend: function(){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: 'success',
                title: 'Sesión iniciada corractamente'
              })
        },
        success:function (){
            window.location.replace("../dashboard.php"); 
           
        },
        error:function(response){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Error inesperado!',
                showConfirmButton: false
              })
        }
    })
    

})