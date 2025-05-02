<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;
    // echo '<pre>';
    // print_r($post);

    if (
        $post['fullname'] && $post['email'] && $post['objective']
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
        // $titleres = $db->real_escape_string($post('resume_title'));
     

        // $coulum = '';
        // $values = '';
        // foreach ($post as $index => $value) {
        //     $$index = $db->real_escape_string($value);
        //     $coulum .= $index . ',';
        //     $values .= "'" . $db->real_escape_string($value) . "',";
        // }

        $coulum = 'fullname,email,objective,mobile_no,dob,gender,religion,nationality,martial_status,hobbies,languages,address,sludg,updated_at,user_id,resume_title';

        $authid = $fn->Auth()['id'];

        $titleres = $db->real_escape_string($post['resume_title']);
$values = "'$fullname','$email','$objective','$mobile_no','$dob','$gender','$religion','$nationality','$martial_status','$hobbies','$languages','$address','".$fn->randomstring()."','".time()."',$authid,'$titleres'";

            // print_r($values);
        // echo $values;
        // $time = time();
        // echo $time;

        try {

            $db->query("INSERT INTO resumes ($coulum) VALUES ($values)");
            // echo "Data inserted successfully";
            // $query = "INSERT INTO resumes";
            // $query .= "($coulum)";
            // $query .= "VALUES($values)";

            // echo $query;

            // Use prepared statements to prevent SQL injection
            // $stmt = $db->prepare($query);
            // $stmt->execute();

            $fn->setAlert(" Resume added succesfully !");
            $fn->redirect('../myresumes.php');
        } catch (Exception $error) {
            echo "Data not sent"; 
            $fn->setError($error->getMessage());
            // $fn->redirect('../createresume.php');
        }
    } else {
        $fn->setError("plz fill the form !");
        // $fn->redirect('../createresume.php');
    }
} else {
    // $fn->redirect('../createresume.php');
}
?>
