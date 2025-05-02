<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;
    // echo '<pre>';
    // print_r($post);

    if (
         $post['position'] && $post['company'] && $post['started']
        && $post['ended'] && $post['job_desc'] && $post['resume_id'] && $post['sludg']
    ) {

        $position = $db->real_escape_string($post['position']);
        $company = $db->real_escape_string($post['company']);
        $started = $db->real_escape_string($post['started']);
        $resumeid = $post['resume_id'];
        $job_desc = $db->real_escape_string($post['job_desc']);
        $ended = $db->real_escape_string($post['ended']);
        
     $sper = $post['sludg'];
        $coulum = 'resume_id,position,company,job_desc,started,end';


//         $titleres = $db->real_escape_string($post['resume_title']);
$values = "'$resumeid','$position','$company','$job_desc','$started','$ended'";

            // print_r($values);
        // echo $values;
        // $time = time();
        // echo $time;

        try {

            $db->query("INSERT INTO experiences ($coulum) VALUES ($values)");
            // echo "Data inserted successfully";
            // $query = "INSERT INTO resumes";
            // $query .= "($coulum)";
            // $query .= "VALUES($values)";

            // echo $query;

            // Use prepared statements to prevent SQL injection
            // $stmt = $db->prepare($query);
            // $stmt->execute();

            $fn->setAlert(" Experience added succesfully !");
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
