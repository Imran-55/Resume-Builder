<?php
// session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';




if ($_POST) {
    $post = $_POST;
    if ($post['password']) {
        $password = md5($db->real_escape_string($_POST['password']));
        $email = $fn->getSession('email');

        $db->query("UPDATE user SET password='$password' WHERE email='$email'");
        $fn->setAlert("Password change Succesfully!");
        $fn->redirect('../login.php');


    } else {
        $fn->setError("plz enter your new password!");
        $fn->redirect('../change-password.php');

    }
} else {
    $fn->redirect('../change-password.php');
}
?>