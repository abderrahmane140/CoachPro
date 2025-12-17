<?php

$db_host = 'localhost';
$db_name = 'coachpro';
$db_username = 'root';
$db_password = 'Password123!';

try{
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);


    //FOR PROCESSING THE DATA AS ASSOCIATE ARRAY
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //FOR HANDLIGN THE ERROR
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);



}catch(PDOException $e){
    echo "connection feild" . $e->getMessage();
    exit;
}

?>