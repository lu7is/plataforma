<?php
require("conexion.php");

class Usuarios extends BD {

    public function __construct(){
        $this->db = parent::__construct();
    }

    public function Registrar($Cedula, $Nombre, $Apellido, $Telefono, $Direccion, $Correo, $Password, $Rol){
        $statement = $this->db->prepare("INSERT INTO usuarios (cedula, nombre, apellido, telefono, direccion, correo, password, estado, rol)
                                        VALUE (:Cedula, :Nombre, :Apellido, :Telefono, :Direccion, :Correo, :Password, 'activo', :Rol )");
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
                                         WHERE estado = 'activo'");
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
                'id_usuario' => $row['id_usuario']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
   
    public function Listar_Id($Id){
        
        $statement = $this->db->prepare("SELECT *  FROM usuarios WHERE id_usuario = :Id ");
        $statement->bindParam(':Id', $Id);
        $statement->execute();

        $json= array();
        while($row = $statement->fetch()){  
          $json[]  = array( 
            'cedula' => $row['cedula'],
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'telefono' => $row['telefono'],
            'direccion' => $row['direccion'],
            'correo' => $row['correo'],
            'rol' => $row['rol'],
            'id_usuario' => $row['id_usuario'],
          );

         
        }

        $jsonstring = json_encode($json[0]);
         echo $jsonstring;
    }

    public function Actualizar($Id,$Cedula, $Nombre, $Apellido, $Telefono, $Direccion, $Correo, $Rol){
        $statement = $this->db->prepare("UPDATE usuarios SET cedula = :Cedula, nombre =:Nombre, apellido = :Apellido, telefono = :Telefono,
                                        direccion = :Direccion, correo = :Correo, rol = :Rol WHERE id_usuario = :Id");
        $statement->bindParam(':Id',$Id);
        $statement->bindParam(':Cedula',$Cedula);
        $statement->bindParam(':Nombre',$Nombre);
        $statement->bindParam(':Apellido',$Apellido);
        $statement->bindParam(':Telefono',$Telefono);
        $statement->bindParam(':Direccion',$Direccion);
        $statement->bindParam(':Correo',$Correo);
        $statement->bindParam(':Rol',$Rol);
        $statement->execute();
            
        
    }

    public function Eliminar($Id){
        $statement = $this->db->prepare("UPDATE usuarios SET estado = 'inactivo' WHERE id_usuario = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
    }

    public function List_Clientes(){
        $rows = null;
        $statement = $this->db->prepare("SELECT * FROM usuarios WHERE rol = 'cliente' AND estado = 'activo'");
        $statement->execute();
        while($result = $statement->fetch()){
            $rows[] = $result;
        }
        return $rows;
    }

    public function List_Proveedor(){
        $rows = null;
        $statement = $this->db->prepare("SELECT * FROM usuarios WHERE rol = 'proveedor' AND estado = 'activo'");
        $statement->execute();
        while($result = $statement->fetch()){
            $rows[] = $result;
        }
        return $rows;
    }

    public function Contar(){
        $rows = null;
        
        $statement = $this->db->prepare("SELECT COUNT(*) FROM usuarios WHERE estado= 'activo'");
        $statement->execute();

        while($result = $statement->fetch()){
            $rows[] = $result;
        }
        

        echo $rows;
        
    }

    













}


?>