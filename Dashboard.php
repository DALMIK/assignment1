<?php 
require_once("./config.php");
include("./SignupQuery.php");
require('./vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader);
$SignupObj = new SignupQuery($con);

if(isset($_GET['del'])) 
{
    $result = $SignupObj->deleteRecord($_GET['del']);
    if($result){
        echo "<script>alert('Data Succefully Deleted')</script>";
        header("Location: ./Dashboard.php");
    }else{
        echo "<script>alert('Something Went Wrong')</script>";
    }
}





$res = $SignupObj->getRecord();


echo $twig->render('Dashboard.html.twig',['employee'=>$res[0]]);

?>