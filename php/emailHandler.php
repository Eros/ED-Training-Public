<?php
if(isset($_POST['email'])){
    $email_to = "replace with email here";
    $email_subject = "Subject";

    function error($error){
        echo "Sorry an error has occured, please check all the information is correct!";
        echo "$error";
        die();
    }

    if(!isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['email']) || !isset($_POST['telephone']) || !isset($_POST['COMMENTS'])){
        error('Some information is missing!');
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_from = $_POST['email'];
    $phone = $_POST['telephone'];
    $comments = $_POST['comments'];
    $error_message = "";
    $email_regex = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/'; //fucking regex
    if(!preg_match($email_regex, $email_from)){
        $error_message .= "The email you have entered is not valid!";
    }
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp, $first_name)){
        $error_message .= "The first name entered is not valid!";
    }
    if(!preg_match($string_exp, $last_name)){
        $error_message .= "The last name entered is not valid!";
    }
    if(strlen($comments) < 2){
        $error_message .= "The comments you have submitted are not valid!";
    }
    if(strlen($error_message) > 0){
        die();
        error($error_message);
    }

    $email_message = "Details below`\n\n";

    function clean_string($string){
        $bad = array("content-type", "bcc:", "to:", "cc:", "href"); //prevents stupid shit from being sent
        return str_replace($bad, "", $string);
    }

    $email_message .= 'First name: '.clean_string($first_name);
    $email_message .= 'Last name'.clean_string($last_name);
    $email_message .= 'Email'.clean_string($email_from);
    $email_message .= 'Phone number: '.clean_string($phone);
    $email_message .= 'Contents: '.clean_string($comments);

    $headers = 'From: '.$email_from. "\r\n";
    'Reply to:'.$email_from.'\r\n';
    @mail($email_to, $email_subject, $email_message, $headers);
}
?>
