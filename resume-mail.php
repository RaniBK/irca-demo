<?php
if($_POST && isset($_FILES['my_file']))
{

    $from_email         = $_POST['email']; //from mail, it is mandatory with some hosts
    $recipient_email    = 'pavan.tg34892@gmail.com'; //recipient email (most cases it is your personal email)
    //$portfolio_link = $_POST["link"]; //portfolio link taken from input name
    
    //Capture POST data from HTML form and Sanitize them, 
    $sender_name    = filter_var($_POST["name"], FILTER_SANITIZE_STRING); //sender name
    $reply_to_email = filter_var($_POST["email"], FILTER_SANITIZE_STRING); //sender email used in "reply-to" header
    $subject        = filter_var($_POST["no"], FILTER_SANITIZE_STRING); //get subject from HTML form
    $message        = filter_var($_POST["message"], FILTER_SANITIZE_STRING); //message
    
    
    //Get uploaded file data
    $file_tmp_name    = $_FILES['my_file']['tmp_name'];
    $file_name        = $_FILES['my_file']['name'];
    $file_size        = $_FILES['my_file']['size'];
    $file_type        = $_FILES['my_file']['type'];
    $file_error       = $_FILES['my_file']['error'];
       
       if ($file_error == 0)
       { 
       		$handle = fopen($file_tmp_name, "r");
   		 $content = fread($handle, $file_size);
    		fclose($handle);
   		 $encoded_content = chunk_split(base64_encode($content));

      		  $boundary = md5("sanwebe");

      		  $headers = "MIME-Version: 1.0\r\n"; 
      		  $headers .= "From:".$from_email."\r\n"; 
      		  $headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
      		  $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
        
		        $body = "--$boundary\r\n";
      		  $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
      		  $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
      		  $body .= chunk_split(base64_encode($message)); 
        
      		  $body .= "--$boundary\r\n";
     		   $body .="Content-Type: $file_type; name=".$file_name."\r\n";
       		 $body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
      		  $body .="Content-Transfer-Encoding: base64\r\n";
      		  $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
     		   $body .= $encoded_content; 
    
   		 $sentMail = @mail($recipient_email, $subject, $body, $headers);
  		  if($sentMail)
   		  {       
       	    		 header( "refresh:5;url=careers.html" ); 
  			echo 'Application received. You\'ll be redirected in about 5 secs. If not, click <a href="careers.html">here</a>.';
  		  }
  		 else
  		 {
   		     die('Could not send mail! Please check your PHP mail configuration or contact the admin.');  
   		 }
       }
       
  else
  {
  	die('Error!');
  }

}
?>