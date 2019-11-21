
<?php

require('conexion.php');

function buscarcarrera(){
    
    $cn = getConexion();
    $stm = $cn->query("SELECT * FROM carrera");
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach($rows as $row){
        $data[] = [
            "id" => $row["id"],
            "nombre" => $row["nombre"]
        ];
    }

    // print_r($data);
    header("Content-Type: application/json", true);
    $data = json_encode($data);
    echo $data;
    
       
   // $postdata= file_get_contents("php://input");
    //$data = json_decode($postdata, true);

    //$cn = getConexion();
    //$stm = $cn->prepare('SELECT id, nombre FROM carrera');
    //
      
    // echo 'buscar carrera1';
}

function guardarcarrera(){

    $postdata= file_get_contents("php://input");
    $data = json_decode($postdata, true);
    
    $cn = getConexion();
    $stm = $cn->prepare('INSERT INTO carrera (nombre) VALUES(:nombre)');
    $stm->bindParam(":nombre", $data["nombre"]);
    $data = $stm->execute();

    echo $data;

     //print_r($data);
    header("Content-Type: application/json", true);
    $data = json_encode($data);
    echo $data;
   
      
   // $postdata= file_get_contents("php://input");
    //$data = json_decode($postdata, true);

    //$cn = getConexion();
    //$stm = $cn->prepare('INSERT INTO carrera (nombre) VALUES(:nombre)');
    //$stm->bindParam(":nombre", $data["nombre"]);
    //$data = $stm->execute();
    echo 'guardar carrera';
}

function eliminarcarrera($id){
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
 $stm = $cn->prepare("DELETE FROM carrera WHERE id= :id"); 
 $stm->bindParam(":id", $id); 


 $data = $stm->execute();
 // echo 'Carrera Eliminada!';
}

function actualizarcarrera($id){
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
  $stm = $cn->prepare("UPDATE carrera SET nombre=:nombre Where id = :id"); 
  $stm->bindParam(':nombre',  $data["nombre"]); 
  $stm->bindParam(":id", $id); 
  $data = $stm->execute();
  
  
}


//print_r($_SERVER);

$method = $_SERVER['REQUEST_METHOD'];

switch($method){

    case 'POST':
    guardarcarrera();
    break;

    case 'GET':
    buscarcarrera();
    break;

    case 'DELETE':
        $id = $_GET["id"];
        eliminarcarrera($id);

    case 'PUT':
        $id = $_GET["id"];
        actualizarcarrera($id);
    default:
    echo 'to be Implemented';
}