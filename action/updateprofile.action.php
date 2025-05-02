<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;
    if ($post['fullname'] && $post['email']) {
        $full_name = $db->real_escape_string($post['fullname']);
        $email = $db->real_escape_string($post['email']);
        $password = md5($db->real_escape_string($post['password']));
        $authid = $fn->Auth()['id'];

        $result = $db->query("SELECT COUNT(*) as user FROM user WHERE (email='$email' AND id!=$authid)");
        $result = $result->fetch_assoc();

        if ($result['user']) {
            $fn->setError("is already registered, please enter another email");
            $fn->redirect('../account.php');
        }

        if ($password != '') {
            $db->query("UPDATE user SET full_name='$full_name', email='$email', password='$password' WHERE id=$authid");
        } else {
            $db->query("UPDATE user SET full_name='$full_name', email='$email' WHERE id=$authid");
        }

        $fn->setAlert("Profile updated successfully!");
        $fn->redirect('../account.php');
    } else {
        $fn->setError("Please fill the form!");
        $fn->redirect('../account.php');
    }
} else {
    $fn->redirect('../account.php');
}
?>
