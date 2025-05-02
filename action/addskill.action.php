<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;
    echo '<pre>';
    print_r($post);
    // die();

    if (
         $post['skill'] && $post['resume_id'] && $post['sludg']
    ) {
        $resumeid= $post['resume_id'];
        $skill = $db->real_escape_string($post['skill']);
        
     $sper = $post['sludg'];
        $coulum = 'resume_id,skill';


//         $titleres = $db->real_escape_string($post['resume_title']);
$values = "'$resumeid','$skill'";

            // print_r($values);
        // echo $values;
        // $time = time();
        // echo $time;

        try {

            $db->query("INSERT INTO slills ($coulum) VALUES ($values)");
            // echo "Data inserted successfully";
            // $query = "INSERT INTO resumes";
            // $query .= "($coulum)";
            // $query .= "VALUES($values)";

            // echo $query;

            // Use prepared statements to prevent SQL injection
            // $stmt = $db->prepare($query);
            // $stmt->execute();

            $fn->setAlert(" skill added succesfully !");
            $fn->redirect('../updateresume.php?resume='.$sper);
        } catch (Exception $error) {
            echo "Data not sent"; 
            $fn->setError($error->getMessage());
            $fn->redirect('../updateresume.php?resume='.$sper);
        }
    } else {
        $fn->setError("plz fill the form !");
        $fn->redirect('../updateresume.php?resume='.$sper);    }
} else {
    $fn->redirect('../updateresume.php?resume='.$sper);
}
?>
