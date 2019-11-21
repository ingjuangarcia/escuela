<?php

require('conexion.php');

function buscarmateria(){
    $cn = getConexion();
    $stm = $cn->query("SELECT * FROM materia");
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
    $data = json_encode($rows);
    echo $data;
}

function guardarmateria(){

    $postdata= file_get_contents("php://input");
    $data = json_decode($postdata, true);
    
    $cn = getConexion();
    $stm = $cn->prepare("INSERT INTO materia (nombre, credito) VALUES (:nombre, :credito)");
    $stm->bindParam(":nombre", $data["nombre"]);
    $stm->bindParam(":credito", $data["credito"]);
    
    $data = $stm->execute();

   // echo $data;

   // print_r($data);
    //header("Content-Type: application/json", true);
    // $data = json_encode($data);
    // echo $data;
   
    //echo 'guardar materia';
}


function eliminarmateria($id){
      if($id==null){
       header("HTTP/1.1 400 Bad request");
        $response=[
            "error"=>true,
            "message"=>"Campo id es requerido"
        ];
        echo json_encode($response);
        
        return;

      }
    
    //$postdata = file_get_contents("php://input");
    //$data = json_decode($postdata, true);
    
   $cn = getConexion();
   $stm = $cn->prepare("DELETE FROM materia WHERE id= :id"); 
   $stm->bindParam(":id", $id); 
  
  
   $data = $stm->execute();
   // echo 'Materia Eliminada!';
}

function actualizarmateria($id){
      if($id==null){
       header("HTTP/1.1 400 Bad request");
        $response=[
            "error"=>true,
            "message"=>"Campo id es requerido"
        ];
        echo json_encode($response);
        
        return;

      }
    $postdata = file_get_contents("php://input");
    $data = json_decode($postdata, true);
    
    $cn = getConexion();
	$stm = $cn->prepare("UPDATE materia SET nombre=:nombre Where id = :id"); 
    $stm->bindParam(':nombre',  $data["nombre"]); 
    $stm->bindParam(":id", $id); 
    $data = $stm->execute();
    
    
}


//print_r($_SERVER);

$method = $_SERVER['REQUEST_METHOD'];

header("Content-Type: application/json", true);

switch($method){

    case 'POST':
        guardarmateria();
        break;

    case 'GET':
        buscarmateria();
        break;

    case 'DELETE':
        $id = $_GET["id"];
        eliminarmateria($id);
        break;

    case 'PUT':
        $id = $_GET["id"];
        actualizarmateria($id);
        break;
    default:
        echo 'to be Implemented';
}