<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;
    echo '<pre>';
    print_r($post);
    // die();

    if (
         $post['course'] && $post['institute'] && $post['started']
        && $post['ended'] && $post['resume_id'] && $post['sludg']
    ) {

        $course = $db->real_escape_string($post['course']);
        $institute = $db->real_escape_string($post['institute']);
        $started = $db->real_escape_string($post['started']);
        $resumeid = $post['resume_id'];
        // $job_desc = $db->real_escape_string($post['job_desc']);
        $ended = $db->real_escape_string($post['ended']);
        
     $sper = $post['sludg'];
        $coulum = 'resume_id,course,institute,started,ended';


//         $titleres = $db->real_escape_string($post['resume_title']);
$values = "'$resumeid','$course','$institute','$started','$ended'";

            // print_r($values);
        // echo $values;
        // $time = time();
        // echo $time;

        try {

            $db->query("INSERT INTO educations ($coulum) VALUES ($values)");
            // echo "Data inserted successfully";
            // $query = "INSERT INTO resumes";
            // $query .= "($coulum)";
            // $query .= "VALUES($values)";

            // echo $query;

            // Use prepared statements to prevent SQL injection
            // $stmt = $db->prepare($query);
            // $stmt->execute();

            $fn->setAlert(" Education added succesfully !");
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
