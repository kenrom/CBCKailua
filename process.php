<?php
//add the recipient's address here
$myemail = 'cbckailua@gmail.com,cbckailua@hawaii.rr.com';
 
//grab named inputs from html then post to #thanks
if (isset($_POST['name'])) {
$name = strip_tags($_POST['name']);
$email = strip_tags($_POST['email']);
$message = strip_tags($_POST['message']);
echo "<h3>Your message has been received. Thanks! Here is what you submitted:</h3>";
echo "<stong>Name:</strong> ".$name."<br>";   
echo "<stong>Email:</strong> ".$email."<br>"; 
echo "<stong>Message:</strong> ".$message."<br>";
 
//generate email and send!
$to = $myemail;
$email_subject = "An Inquiry From CBC Kailua's Website: $name";
$email_body = "You have received a new message. ".
" Here are the details:\n Name: $name \n ".
"Email: $email\n Message \n $message";
$headers = "From: $myemail" . "\r\n";
$headers .= "Reply-To: $email" . "\r\n";
$headers .= "Bcc: ken.romero@gmail.com" . "\r\n";
mail($to,$email_subject,$email_body,$headers);
}
?>