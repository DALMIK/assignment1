<?php 

session_start();

try{
    
    $con = new PDO("mysql:dbname=employee;host=localhost","root","");

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    // if($con){
    //     echo "connection succefull";
    // }else{
    //     echo "not working";
    // }

}
catch(PDOException $e){
    echo("Connection Failed..." . $e->getMessage());
}



?>