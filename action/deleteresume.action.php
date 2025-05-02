<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $authid = $fn->Auth()['id'];
    // $sper = $_GET['sludg'];

    try {
        $query = "DELETE resumes, slills, educations, experiences FROM resumes ";
        $query .= "LEFT JOIN slills ON resumes.id = slills.resume_id ";
        $query .= "LEFT JOIN educations ON resumes.id = educations.resume_id ";
        $query .= "LEFT JOIN experiences ON resumes.id = experiences.resume_id ";
        $query .= "WHERE resumes.id = $id AND resumes.user_id = $authid";

        echo $query;
        $db->query($query);

        $fn->setAlert("Resume deleted successfully!");
        $fn->redirect('../updateresume.php?resume=' . $sper);
    } catch (Exception $error) {
        echo 'data not delete';
        $fn->setError("Failed to delete Resume: " . $error->getMessage());
        $fn->redirect('../updateresume.php?resume=' . $sper);
    }
} else {
    $fn->setError("Please fill the form!");
    $fn->redirect('../updateresume.php?resume=' . $sper);
}
?>
