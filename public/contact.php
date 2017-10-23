<?php
if(isset($_POST['inputEmail'])) {
 
    //This is the email address that will receive all form submittions
    $email_to = "triplesparkdesign@gmail.com";
    //This is the subject of the email that will be received to distinguish it from other emails received
    $email_subject = "Form Inquiry from website contact form";
 
    function died($error) {
        //Error handling
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    //Checks that the inputs have value, else it will display the message
    if(!isset($_POST['inputName']) ||
        !isset($_POST['inputEmail']) ||
        !isset($_POST['inputPhone']) ||
        !isset($_POST['inputInquiry'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
    //Grabs all the value from the form input fields
    $inputName = $_POST['inputName']; // required
    $inputEmail = $_POST['inputEmail']; // required
    $inputPhone = $_POST['inputPhone']; // required
    $inputInquiry = $_POST['inputInquiry']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  //Validates that the email input matches a valid email format
  if(!preg_match($email_exp,$inputEmail)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  //Validates that the Name input has normal text value
  if(!preg_match($string_exp,$inputName)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
 
  //Validates that the inquiry textarea has at least 2 characters
  if(strlen($inputInquiry) < 2) {
    $error_message .= 'The Inquiry you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
    //Takes all the input and appends it tot he email_message variable to be passed later on
    $email_message .= "Name: ".clean_string($inputName)."\n";
    $email_message .= "Email: ".clean_string($inputEmail)."\n";
    $email_message .= "Telephone: ".clean_string($inputPhone)."\n";
    $email_message .= "Comments: ".clean_string($inputInquiry)."\n";
 
// This creates the header of the email and the content of the email
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- This will be the message that the use will see when they have submitted the form -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
 
}
?>