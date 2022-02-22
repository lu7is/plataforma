<?php

require_once($_SERVER['DOCUMENT_ROOT']."../../bd/conexion.php");

class Busca extends BD{

    public function __construct(){
        $this->db = parent::__construct();
    }

    public function Buscar($Nombre){
        //$statement = $this->db->prepare("SELECT * FROM tareas WHERE nombre LIKE ':Nombre%'");
        $statement = $this->db->prepare("SELECT * FROM tareas WHERE nombre = :Nombre");
        $statement->bindParam(':Nombre',$Nombre);
        $statement->execute();
        $statement->rowCount() == 1;
     
        $json = array();
        while($row =  $statement->fetch()){
            $json[] = array(
                'nombre' => $row['nombre'],
                'descrip' => $row['descrip'],
                'id' => $row['id']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;  
    }

    public function Registrar($Nonbre,$Descrip,$Prioridad,$Estado){
        $statement = $this->db->prepare("INSERT INTO tareas (nombre, descrip, prioridad, estado)
                                         VALUES (:Nonbre, :Descrip, :Prioridad, :Estado)");
        $statement->bindParam(':Nonbre',$Nonbre);
        $statement->bindParam(':Descrip',$Descrip);
        $statement->bindParam(':Prioridad',$Prioridad);
        $statement->bindParam(':Estado',$Estado);
        if($statement->execute()){
            header("location:../../vistas/usuarios/principal.php ");
        }else{
            header("location:../../vistas/dashboard.php ");
        }
        
    }
    


}

?>



