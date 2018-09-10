<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "store";

    try{
        $dbconn = new PDO('mysql:host=localhost; dbname=store', $username, $password);
    }catch(PDOException $e){
        print "error". $e->getMessage() . "<br>";
        die();
    }

    
?>