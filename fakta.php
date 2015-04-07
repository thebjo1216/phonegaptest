<?php
//för cors
header("Access-Control-Allow-Origin: *");
//för att skicka json
header('Content-Type: application/json');

//hämta från databasen

$database ="192206-rebecca";
$username ="192206_qq63235";
$password = "Rebecca3235";
$dbserver = "rebecca-192206.mysql.binero.se";

$dbh = new PDO("mysql:host={$dbserver}; dbname={$database}; charset=utf8",$username,$password);


//När man trycker på skickaknappen ------------------------------------
if ($_POST['skicka']) {
    $fakta = strip_tags($_POST['fakta']);

    if(strlen($fakta) > 0){ //Om man fyllt i alla uppgifter

        //Lägg till i databasen
        $sql = "INSERT INTO guestbook (fakta) VALUES (
        NULL, '{$fakta}');";
        $stmt = $dbh->prepare($sql); 
        $stmt->execute();

        echo "<b>Ditt inlägg har skickats</b>";
    }
    
    // -----------------------------------------------
$sql = "SELECT * FROM Fakta"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();

//Skriv ut resultatet
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

?>