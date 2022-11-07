<?php
require_once("./config.php");
include("./SignupQuery.php");
require('./vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader);
$SignupObj = new SignupQuery($con);




if(isset($_POST['signup']) && isset($_GET['edit'])){
    $id= $_GET['edit'];
    $name = $_POST['name'];
    $reg_no = $_POST['reg_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $profileType = $_POST['profileType'];
    $hobbie = $_POST['hobbie'];

    $isMailExist = $SignupObj->checkMail($email);
    if($isMailExist){
        echo "<script>alert('Email already exists. Please try another email.')</script>";
    }else {
        $result = $SignupObj->updateData($id,$name,$reg_no,$email,$password,$phone,$profileType,$hobbie);
        if($result){
            header("Location: dashboard.php");
        }else{
            echo "something went wrong";
        }
    }
}


if(isset($_POST['signup'])) 
{
    $name = $_POST['name'];
    $reg_no = $_POST['reg_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $profileType = $_POST['profileType'];
    $hobbie = $_POST['hobbie'];
    
    $file = $_FILES['file'];
    $file_name = time() . basename($file['name']);
    $target_dir = __DIR__ . "/document/" . $file_name;
    
    $isMailExist = $SignupObj->checkMail($email);
    if($isMailExist){
        echo "<script>alert('Email already exists. Please try another email.')</script>";
    } else {
        $result = $SignupObj->insertData($name,$reg_no,$email,$password,$phone,$profileType,$hobbie,$file_name);
        if($result){
            move_uploaded_file($file['tmp_name'], $target_dir);
            header("Location: dashboard.php");
        }else{
            echo "something went wrong";
        }
    }
    
}

if(isset($_GET['edit'])){
    $record = array();
    $data = $SignupObj->detailRecord($_GET['edit']);
    echo "<pre>";
    array_push($record,$data);
    print_r($record);
}



$Type = $SignupObj->getType();

echo $twig->render('signUp.html.twig', ['status'=>$Type], ['record'=>"student"]);



?>