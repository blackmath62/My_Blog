<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "Aucun argument fourni !";
	return false;
   }
	
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));
	
// Create the email and send the message
$to = 'jpochet@lhermitte.fr'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Formulaire de contact de site Web :  $name";
$email_body = "Vous avez reçu un nouveau message de votre formulaire de contact de site Web.\n\n"."Voici les détails:\n\nName: $name\n\nEmail: $email_address\n\nMessage:\n$message";
$headers = "From:'jpochet@lhermitte.fr'\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= 'Content-Type:text/html; charset="utf-8"' . "\n";
$headers .= 'Content-Transfer-Encoding: 8bit';
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>
