<?php session_start();
    require_once('functions/user.php');
//Collecting the data

$numberoferrors = 0;

//Verifying the data, validation

$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] :  $numberoferrors++;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] :  $numberoferrors++;
$email = $_POST['email'] != "" ? $_POST['email'] :  $numberoferrors++;
$password = $_POST['password'] != "" ? $_POST['password'] :  $numberoferrors++;


$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;



if($numberoferrors > 0){

     $session_error = "You have " . $numberoferrors . " error";
    
    if($numberoferrors > 1) {        
        $session_error .= "s";
    }

    $session_error .=   " in your form submission";
    $_SESSION["error"] = $session_error ;

    header("Location: register.php");

}else{

     $newUserId = ($countAllUsers-1);

    $userObject = [
        'id'=>$newUserId,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'email'=>$email,
        'password'=> password_hash($password, PASSWORD_DEFAULT), //password hashing
    ];

    //Check if the user already exists.
    $userExists = find_user($email);

        if($userExists){
            $_SESSION["error"] = "User already exist, Try another email ";
            header("Location: register.php");
            die();
        }
        

    //save in the database;
    save_user($userObject);

    $_SESSION["message"] = "Registration Successful, you can now login " . $first_name;
    header("Location: login.php");
}

