<?php
// session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';



require '../assets/packages/phpmailer/src/Exception.php';
require '../assets/packages/phpmailer/src/PHPMailer.php';
require '../assets/packages/phpmailer/src/SMTP.php';



if ($_POST) {
    $post = $_POST;
    if ($post['email']) {
        $email = $db->real_escape_string($post['email']);

        $result = $db->query("SELECT id,full_name FROM user WHERE (email='$email')");

        // $result = $result->fetch_assoc();

        if ($result && $result->num_rows > 0) {

            $otp = rand(100000,999999);
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                $mail->Username = 'legendalex216@gmail.com';                     //SMTP username
                $mail->Password = 'kybupegvznddtvch';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('verification@ResumeBuilder.com', 'Resume Builder');
                $mail->addAddress($email);     //Add a recipient


                //Attachments

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Forgot Password';
                $mail->Body = 'Your 6 digit verification code is : <b>'.$otp.'</b>';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // $fn->alert('OTP sent to your Email');
                $fn->setSession('otp', $otp);
                $fn->setSession('email', $email);
                $fn->redirect('../verification.php');

            } catch (Exception $e) {
                $fn->setError($mail->ErrorInfo);
                $fn->redirect('../forgot-password.php');
            }



        } else {
            $fn->setError($email . " is not Registered");
            $fn->redirect('../forgot-password.php');
        }




    } else {
        $fn->setError("plz enter Email id !");
        $fn->redirect('../forgot-password.php');

    }
} else {
    $fn->redirect('../forgot-password.php');
}
?>