<?php
//To save the name from the input of the contact form
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

//'info@mywebsite.com' = domain name
$email_from = 'info@mywebsite.com';

$email_subject = "Contact through the website";

$emial_body = "User Name: $name.\n".
                "User Email: $visitor_email.\n".
                "User Message: $message.\n";


//Email to
$to = "scarlett.p42094@gmail.com";

$headers = "From: $email_from \r\n";

$headers . = "Reply to: $visitor_email \r\n";

mail($to, $email_subject, $emial_body, $headers);

header("Location: contact.html");

?>