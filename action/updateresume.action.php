<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    if (
       $post['id'] && $post['sludg'] && $post['fullname'] && $post['email'] && $post['objective']
        && $post['mobile_no'] && $post['dob'] && $post['gender']
        && $post['religion'] && $post['nationality'] && $post['martial_status']
        && $post['hobbies'] && $post['languages'] && $post['address'] && $post['resume_title']
    ) {

        $fullname = $db->real_escape_string($post['fullname']);
        $email = $db->real_escape_string($post['email']);
        $objective = $db->real_escape_string($post['objective']);
        $mobile_no = $post['mobile_no'];
        $dob = $db->real_escape_string($post['dob']);
        $gender = $db->real_escape_string($post['gender']);
        $religion = $db->real_escape_string($post['religion']);
        $nationality = $db->real_escape_string($post['nationality']);
        $martial_status = $db->real_escape_string($post['martial_status']);
        $hobbies = $db->real_escape_string($post['hobbies']);
        $languages = $db->real_escape_string($post['languages']);
        $address = $db->real_escape_string($post['address']);   
        $titleres = $db->real_escape_string($post['resume_title']);
        $sl = $post['sludg'];
        // unset($sl);

        // $authid = $fn->Auth()['id'];

        $query = "UPDATE resumes SET fullname='$fullname', email='$email', objective='$objective', mobile_no='$mobile_no', dob='$dob', gender='$gender', religion='$religion', nationality='$nationality', martial_status='$martial_status', hobbies='$hobbies', languages='$languages', address='$address', updated_at='".time()."',  resume_title='$titleres' WHERE id={$post['id']} AND sludg='{$post['sludg']}'";

        try {
            $db->query($query);
            $fn->setAlert("Resume updated successfully !");
            $fn->redirect('../updateresume.php?resume='.$sl);    
        } catch (Exception $error) {
            $fn->setError($error->getMessage());
            $fn->redirect('../updateresume.php?resume='.$sl);    
        }
    } else {
        $fn->setError("Please fill the form !");
        $fn->redirect('../updateresume.php?resume='.$sl);    
    }
} else {
    $fn->redirect('../updateresume.php?resume='.$sl);    
}

?>
