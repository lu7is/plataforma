<?php
require("conexion.php");

class Usuarios extends BD {

    public function __construct(){
        $this->db = parent::__construct();
    }

    public function Registrar($Cedula, $Nombre, $Apellido, $Telefono, $Direccion, $Correo, $Password, $Rol){
        $statement = $this->db->prepare("INSERT INTO usuarios (cedula, nombre, apellido, telefono, direccion, correo, password, rol)
                                        VALUE (:Cedula, :Nombre, :Apellido, :Telefono, :Direccion, :Correo, :Password, :Rol )");
        $statement->bindParam(':Cedula',$Cedula);
        $statement->bindParam(':Nombre',$Nombre);
        $statement->bindParam(':Apellido',$Apellido);
        $statement->bindParam(':Telefono',$Telefono);
        $statement->bindParam(':Direccion',$Direccion);
        $statement->bindParam(':Correo',$Correo);
        $statement->bindParam(':Password',$Password);
        $statement->bindParam(':Rol',$Rol);

        $statement->execute();
           
        


    }

    public function Listar(){
        
        $statement = $this->db->prepare("SELECT *
                                         FROM usuarios
                                         ORDER BY usuarios.id DESC ");
        $statement->execute();
        $json = array();
        while($row = $statement->fetch()){
            $json[] = array(
                
                'cedula' => $row['cedula'],
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido'],
                'telefono' => $row['telefono'],
                'direccion' => $row['direccion'],
                'correo' => $row['correo'],
                'rol' => $row['rol'],
                'id' => $row['id']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
   
    public function Listar_Id($Id){
        
        $statement = $this->db->prepare("SELECT * FROM usuarios WHERE id = :Id ");
        $statement->bindParam(':Id',$Id);
        $statement->execute();
        $json = array();
        while($row = $statement->fetch()){
            $json[] = array(
                'cedula' => $row['cedula'],
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido'],
                'telefono' => $row['telefono'],
                'direccion' => $row['direccion'],
                'correo' => $row['correo'],
                'rol' => $row['rol'],
                'id' => $row['id']
            );
        }
        $jsonstring = json_encode([0]);
        echo $jsonstring;
    }

    public function Actualizar($Id,$Cedula, $Nombre, $Apellido, $Telefono, $Direccion, $Correo, $Password, $Rol){
        $statement = $this->db->prepare("UPDATE usuarios SET cedula = :Cedula, nombre =:Nombre, apellido = :Apellido, telefono = :Telefono,
                                        direccion = :Direccion, correo = :Correo, password = :Password, rol = :Rol WHERE id = :Id");
        $statement->bindParam(':Id',$Id);
        $statement->bindParam(':Cedula',$Cedula);
        $statement->bindParam(':Nombre',$Nombre);
        $statement->bindParam(':Apellido',$Apellido);
        $statement->bindParam(':Telefono',$Telefono);
        $statement->bindParam(':Direccion',$Direccion);
        $statement->bindParam(':Correo',$Correo);
        $statement->bindParam(':Password',$Password);
        $statement->bindParam(':Rol',$Rol);
        if($statement->execute()){
            header("location:../../vistas/usuarios/principal.php ");
        }else{
            header("location:../../vistas/dashboard.php ");
        }
    }

    public function Eliminar($Id){
        $statement = $this->db->prepare("DELETE FROM usuarios WHERE id = :Id ");
        $statement->bindParam(':Id', $Id);
        if($statement->execute()){
            header("location:../../vistas/usuarios/principal.php ");
        }else{
            header("location:../../vistas/dashboard.php ");
        }
        
        return $rows;
    }

    public function List_Clientes(){
        $rows = null;
        $statement = $this->db->prepare("SELECT * FROM usuarios WHERE rol = 'cliente'");
        $statement->execute();
        while($result = $statement->fetch()){
            $rows[] = $result;
        }
        return $rows;
    }

    













}


?>