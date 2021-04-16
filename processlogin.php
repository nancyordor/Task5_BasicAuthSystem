<?php session_start();

require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/user.php');

$numberoferrors = 0;

$email = $_POST['email'] != "" ? $_POST['email'] :  $numberoferrors++;
$password = $_POST['password'] != "" ? $_POST['password'] :  $numberoferrors++;

$_SESSION['email'] = $email;

if($numberoferrors > 0){

    $session_error = "You have " . $numberoferrors . " error";
    
    if($numberoferrors > 1) {        
        $session_error .= "s";
    }

    $session_error .=   " in your form submission";
    
    set_alert('error',$session_error);
      
    redirect_to("login.php");

}else{
    
    $currentUser = find_user($email);

        if($currentUser){
          //check the user password.
            $userString = file_get_contents("database/users/".$currentUser->email . ".json");
            $userObject = json_decode($userString);
            $passwordFromdatabase = $userObject->password;

            $passwrodFromUser = password_verify($password, $passwordFromdatabase);
            
            if($passwordFromdatabase == $passwrodFromUser){
                //redicrect to dashboard
                $_SESSION['loggedIn'] = $userObject->id; 
                $_SESSION['email'] = $userObject->email;
                $_SESSION['fullname'] = $userObject->first_name . " " . $userObject->last_name;
               
                
                redirect_to("dashboard.php");
                die();
            }
          
        }        
        

    set_alert('error',"Invalid Email or Password");
    redirect_to("login.php");
    die();

}