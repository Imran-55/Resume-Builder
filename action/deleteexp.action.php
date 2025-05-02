<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_GET) {
    $post = $_GET;
    // echo '<pre>';
    // print_r($post);

    if (
         $post['id'] && $post['resume_id'] && $post['sludg'] 
    ) {

        $sper = $post['sludg'];

        try {

            $query = "DELETE FROM experiences WHERE id={$post['id']} AND resume_id={$post['resume_id']}";
            // print_r($query);
          $db->query($query);
        //   echo"dadta delted";

            $fn->setAlert(" Experience deleted succesfully !");
            $fn->redirect('../updateresume.php?resume='.$sper);
        } catch (Exception $error) {
            echo "Data not sent"; 
            $fn->setError($error->getMessage());
            $fn->redirect('../updateresume.php?resume='.$sper);
        }
    } else {
        $fn->setError("plz fill the form !");
        $fn->redirect('../updateresume.php?resume='.$sper);    
    }
} else {
    $fn->redirect('../updateresume.php?resume='.$sper);
}
?>
