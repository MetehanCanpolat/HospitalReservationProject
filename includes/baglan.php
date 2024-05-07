<?php
    $sunucu = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "hastane";
    $baglan = false;

    try{
        $baglan = new PDO("mysql:host=".$sunucu.";dbname=".$db_name.";charset=utf8",$db_user,$db_password);
        //echo "BAĞLANTI BAŞARILI ";
    }catch(PDOException $e){
        echo $e -> getMessage();
        exit();
    }
    

?>