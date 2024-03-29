
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="../../css/login.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Meraki Brand</h3></div>
                                    <div class="card-body">
                                        <form id="form_login">
                                         
                                               
                                   
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="Correo" type="email" placeholder="Correo"  />
                                                <label for="inputEmail">Correo Electronico</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="Password" type="password" placeholder="Contraseña" />
                                                <label for="inputPassword">Contraseña</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Recordar la contraseña</label>
                                            </div>
                                            <a class="small" href="password.html">Olvidaste tu contraseña?</a>
                                            <div id="iniciar">
                                                
                                                <button type="submit" class="btn btn-primary" >Iniciar Sesíon</button>
                                                <a href="../index.html"><button type="button" class="btn btn-danger" >Cancelar</button></a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Necesitas una cuenta para iniciar sesion!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Politicas de privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                  <script src="../../js/scripts.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
                  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                  <!-- AQUI LISTAMOS NUESTRO ARCHIVO JS -->
                  <script src="../../js/login.js"></script>
                  <!-- aqui importamos css local -->
                   <!-- jQuery, Popper.js, Bootstrap JS -->
                  <script src="../../app/assets/jquery/jquery-3.3.1.min.js"></script>
                  <script src="../../app/assets/popper/popper.min.js"></script>
                  <script src="../../app/assets/bootstrap/js/bootstrap.min.js"></script> 
                  <!-- sweet alert JS -->
                  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       
    </body>
</html>
