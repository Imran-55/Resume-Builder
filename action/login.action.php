<?php
session_start();
require'../assets/class/database.class.php';
require'../assets/class/function.class.php';




if($_POST){
 $post = $_POST;
 if( $post['email'] && $post['password']){
    $email = $db->real_escape_string($post['email']);
    $password = md5($db->real_escape_string($post['password']));

    $result= $db->query("SELECT id,full_name FROM user WHERE (email='$email' && password='$password')");
    
    // $result = $result->fetch_assoc();

    if ($result && $result->num_rows > 0) {
        $_SESSION['alert'] = "Logged in !";
        $fn->setAuth($result->fetch_assoc());
        $fn->redirect('../myresumes.php');
    } else {
        $fn->setError("Incorrect email id or Password");
        $fn->redirect('../login.php');
    }
    

 

 }else{
    $fn->setError("plz fill the form !");
    $fn->redirect('../register.php');
   
 }
}else{
    $fn->redirect('../register.php');
}
?>