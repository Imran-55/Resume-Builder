<?php
session_start();
require'../assets/class/database.class.php';
require'../assets/class/function.class.php';




if($_POST){
 $post = $_POST;
 if($post['fullname'] && $post['email'] && $post['password']){
    $full_name = $db->real_escape_string($post['fullname']);
    $email = $db->real_escape_string($post['email']);
    $password = md5($db->real_escape_string($post['password']));

    $result = $db->query("SELECT COUNT(*) as user FROM user WHERE (email='$email' AND password='$password')");
    $result = $result->fetch_assoc();

    if($result['user']){
       
        $fn->setError("is already registerd pls enter another email");
        $fn->redirect('../register.php');
        // die();
    }

    try{
        $db->query("INSERT INTO user(full_name,email,password)VALUES ('$full_name', '$email','$password')");
        $fn->setAlert(" You registerd succesfully !");
        $fn->redirect('../login.php');
    }catch(Exception $error){
        
        $fn->setError($error->getMessage());
        $fn->redirect('../register.php');

    }

 }else{
    $fn->setError("plz fill the form !");
    $fn->redirect('../register.php');
   
 }
}else{
    $fn->redirect('../register.php');
}
?>