<?php 
if(isset($_POST['email'])){
    $to = "pavan.tg34892@gmail.com";
    $sub = $_POST['subject'];
	$first_name = $_POST['firstname'];
	$company = $_POST['company'];
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $msg = $_POST['message'];
	$city = $_POST['city'];
	$phone = $_POST['phone'];
    $subject = "Form submission";
    $subject2 = "Copy of your form submission";
    $message = "Subject:" . $sub . "\n\n Name:" . $name . "\n Email: " . $from . "\n Message:" . $msg . "\nCity:" . $city . "\nPhone" . $phone . "\nFirst-Name:" . $first-name . "\nCompany" . $company;

    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
    }
?>