
<?php
 
 $postdata= file_get_contents("php://input");

 $estudiante = json_decode($postdata);
 
 try {
  $pdo = new \PDO("mysql:host=localhost;dbname=escuela", "root", "password");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // $stm = $pdo->query("SELECT VERSION()");
  // $version = $stm->fetch();
  // echo $version[0] . PHP_EOL;

  
  $stm = $pdo->prepare("INSERT INTO estudiante (nombre, matricula, edad, carrera_id) 
  VALUES (:nombre, :matricula, :edad, :carrera_id)");
  $stm->bindParam(":nombre", $estudiante->nombre);
  $stm->bindParam(":matricula", $estudiante->matricula);
  $stm->bindParam(":edad", $estudiante->edad);
  $stm->bindParam(":carrera_id", $estudiante->carrera_id);
  $data = $stm->execute();
  print_r($data);

  echo "working";
} catch (PDOException $e){
  echo $e->getMessage();
}
 //echo 'El estudiante '.$estudiante->nombre.',matricula: '.$estudiante->matricula;


 //$estudiante = json_decode($postdata, true);
 //echo 'El estudiante '.$estudiante[nombre].',matricula: '.$estudiante["matricula"];

 ?>
 

