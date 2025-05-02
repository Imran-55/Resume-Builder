<?php 
session_start();
// require './assets/includes/footer.php';


class functions{
    public function redirect($address){
        header("Location: " . $address);
        // exit(); // It's a good practice to add exit() after a redirect to prevent further script execution
        
    }

    public function setError($msg){
        $_SESSION['error']= $msg;
    }
    public function error(){
        if(isset($_SESSION['error'])){
            $errorMessage = $_SESSION['error'];
            // Escape single quotes within the error message
            $errorMessage = str_replace("'", "\'", $errorMessage);
        
            echo "Swal.fire({
                title: '',
                text: '$errorMessage',
                icon: 'error'
            });";
            unset($_SESSION['error']);
        }
        
    }
    
    
    public function setAlert($msg){
        $_SESSION['alert'] = $msg;
    }
    public function alert(){
        if(isset($_SESSION['alert'])){
            echo "Swal.fire({
                title: '',
                text: '".$_SESSION['alert']."',
                icon: 'success'
              })";
            unset($_SESSION['alert']);
        }
    }
    public function setAuth($data){
        $_SESSION['Auth']=$data;
    }
    public function Auth(){
        if(isset($_SESSION['Auth'])){
           return $_SESSION['Auth'];
        }else{
            return false;
        }
    }

    public function Authpage(){
        if(!isset($_SESSION['Auth'])){
            $this->redirect('login.php');
        }
    }
    public function nonAuthpage(){
        if(isset($_SESSION['Auth'])){
            $this->redirect('myresumes.php');
        }
    }

    public function setSession($key,$value){
        $_SESSION[$key] = $value;
    }
    public function getSession($key){
        return $_SESSION[$key]??'';
    }

    public function randomstring(){
        $string = "0123456789abcdefghijklmnopqrstuvwxyz_".time().rand(1111,2222333);
        $string = str_shuffle($string);
        return str_split($string,16)[0];
    }

}
$fn = new functions();
?>
