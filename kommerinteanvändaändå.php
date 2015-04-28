<?php
//för cors
header("Access-Control-Allow-Origin: *");
//för att skicka json
header('Content-Type: application/json');

//hämta från databasen

    $database ="";
    $username ="";
    $password = "";
    $dbserver = "";


$verb = $_SERVER['REQUEST_METHOD'];
if($verb == "GET")
{
    $dbh = new PDO("mysql:host={$dbserver}; dbname={$database}; charset=utf8",$username,$password);
    
    $sql = "SELECT * FROM Hundar";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
       
    //Skriv ut resultatet
  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
  }
  else if($verb == "POST"){
   $post_data = @file_get_contents('php://input');
   $data = json_decode($post_data);
   $namn = $data->Namn;
   $ras = $data->Ras;
   $vikt = $data->Vikt;
   $sql = "INSERT INTO Hundar (Hund_ID,Namn,Ras,Vikt) VALUES(NULL,'{$namn}','{$ras}','{$vikt}')";
   $dbh = new PDO("mysql:host={$dbserver}; dbname={$database}; charset=utf8",$username,$password);
   $stmt = $dbh->prepare($sql);
   $stmt->execute();
   echo "200";
  }
?>