<?php

require('conexion.php');

function buscarestudiante(){
    
    $cn = getConexion();
    $stm = $cn->query("SELECT * FROM estudiante");
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach($rows as $row){
        $data[] = [
            "id" => $row["id"],
            "nombre" => $row["nombre"],
            "matricula" => $row["matricula"],
            "edad" => $row["edad"],
            "carrera_id" => $row["carrera_id"]
        ];
    }

    // print_r($data);
    header("Content-Type: application/json", true);
    $data = json_encode($data);
    echo $data;
    
       
   // $postdata= file_get_contents("php://input");
    //$data = json_decode($postdata, true);

    //$cn = getConexion();
    //$stm = $cn->prepare('SELECT id, nombre FROM estudiante');
    //
      
    // echo 'buscar estudiante';
}

function guardarestudiante(){

    $postdata= file_get_contents("php://input");
    $data = json_decode($postdata, true);
    
    $cn = getConexion();
    $stm = $cn->prepare('INSERT INTO estudiante (nombre, matricula, edad, carrera_id) 
    VALUES(:nombre, :matricula, :edad, :carrera_id)');
    $stm->bindParam(":nombre", $data["nombre"]);
    $stm->bindParam(":matricula", $data["matricula"]);
    $stm->bindParam(":edad", $data["edad"]);
    $stm->bindParam(":carrera_id", $data["carrera_id"]);
    $data = $stm->execute();

    echo $data;

     //print_r($data);
    header("Content-Type: application/json", true);
    $data = json_encode($data);
    echo $data;
   
      
   // $postdata= file_get_contents("php://input");
    //$data = json_decode($postdata, true);

    //$cn = getConexion();
    //$stm = $cn->prepare('INSERT INTO estudiante (nombre, matricula, edad, carrera_id) 
   // VALUES(:nombre, :matricula, :edad, :carrera_id)');
   // $stm->bindParam(":nombre", $data["nombre"]);
   // $stm->bindParam(":matricula", $data["matricula"]);
  // $stm->bindParam(":edad", $data["edad"]);
   // $stm->bindParam(":carrera_id", $data["carrera_id"]);
   // $data = $stm->execute();
    echo 'guardar estudiante';
}

function eliminarestudiante(){
      
    
    $postdata = file_get_contents("php://input");
    $data = json_decode($postdata, true);
    
   $cn = getConexion();
   $stm = $cn->prepare("DELETE FROM estudiante WHERE id=:id"); 
   $stm->bindParam(':id',  $data["id"]); 
   $data = $stm->execute();
    
}

function actualizarestudiante(){
    $postdata = file_get_contents("php://input");
    $data = json_decode($postdata, true);
    
    $cn = getConexion();
	$stm = $cn->prepare("UPDATE estudiante SET nombre='$nombre' Where id=:id"); 
	$stm->bindParam(':nombre',  $data["nombre"]); 
    $stm->bindParam(":id", $id);
    $data = $stm->execute();
  
    
}


//print_r($_SERVER);

$method = $_SERVER['REQUEST_METHOD'];

switch($method){

    case 'POST':
        guardarestudiante();
    break;

    case 'GET':
        buscarestudiante();
    break;

    case 'DELETE':
        $id = $_GET["id"];
        eliminarestudiante($id);
    break;

    case 'PUT':
        $id = $_GET["id"];
        actualizarestudiante($id);
    default:
    echo 'to be Implemented';
}