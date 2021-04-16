<?php session_start();
    require_once('functions/user.php');
    require_once('functions/alert.php');
    require_once('functions/redirect.php');
//Collecting the data

$numberoferrors = 0;

if(!is_user_loggedIn()){

    $token = $_POST['token'] != "" ? $_POST['token'] :  $numberoferrors++;
    $_SESSION['token'] = $token;
}

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

   redirect_to("reset.php");

// }else{
      
//         $checkToken = is_user_loggedIn() ? true :  find_token($email);
       

//            if($checkToken){
           
//                 $userExists = find_user($email);

//                 if($userExists){
                                           
//                         $userObject = find_user($email);

//                         $userObject->password = password_hash($password, PASSWORD_DEFAULT);
            
//                         unlink("database/users/".$currentUser); //file delete, user data delete
//                         unlink("database/token/".$currentUser); //file delete, token data delete

//                         save_user($userObject);

//                         set_alert('message',"You're password has been reset ");

//                         $subject = "Password Reset Successful";
//                         $message = "You just changed your password, If this was not you, Send an email to support@e-ticketing.com";
//                         send_mail($subject,$message,$email);
                       
//                         redirect_to("login.php");
//                         return;
                    
//                     }
        
//     }
    set_alert('error',"Password Reset Failed, token/email invalid or expired");
    redirect_to("login.php");
}
