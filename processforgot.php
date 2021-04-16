<?php session_start();
require_once('functions/alert.php');
require_once('functions/redirect.php');

require_once('functions/user.php');

//Collecting the data

$numberoferrors = 0;

$email = $_POST['email'] != "" ? $_POST['email'] :  $numberoferrors++;
$_SESSION['email'] = $email;

if($numberoferrors > 0){

    $session_error = "You have " . $numberoferrors . " error";
    
    if($numberoferrors > 1) {        
        $session_error .= "s";
    }

    $session_error .=   " in your form submission";

    set_alert('error', $session_error);

    header("Location: forgot.php");

}else{

    $allUsers = scandir("database/users/");
    $countAllUsers = count($allUsers);

    for ($counter = 0; $counter < $countAllUsers ; $counter++) {
        
        $currentUser = $allUsers[$counter];

    //not sure on how to do this
    redirect_to("forgot.php");
        }
}


