
<?php
require_once("conexion.php");
session_start();
class sesion extends BD{

    public function __construct(){
        $this->db = parent::__construct();
    }
    public function login($Correo, $Password){

        $statement = $this->db->prepare("SELECT * FROM usuarios WHERE correo =:Correo AND password = :Password AND estado = 'activo' ");
        $statement->bindParam(':Correo',$Correo);
        $statement->bindParam(':Password',$Password);
        $statement->execute();
        if($statement->rowCount() == 1){
            $result = $statement->fetch();
            $_SESSION['id_usuario'] = $result['id_usuario'];
            $_SESSION['cedula'] = $result['cedula'];
            $_SESSION['nombre'] = $result['nombre'];
            $_SESSION['apellido'] = $result['apellido'];
            $_SESSION['telefono'] = $result['telefono'];
            $_SESSION['direccion'] = $result['direccion'];
            $_SESSION['correo'] = $result['correo'];
            $_SESSION['rol'] = $result['rol'];
            return true;
             
        }else{
         if($statement->rowCount() < 0 ){
        echo '
            <script> 
                alert("Este correo ya esta registrado en la base de datos");
                window.location = "google.com";
            </script>
        
        ';
        }
    }
           
        return false;
            
    }



    public function ValidarInicio(){
        if($_SESSION['id']== null ){
    header("location:../../vistas/dashboard.php");

        }
    }





}

?>











   








