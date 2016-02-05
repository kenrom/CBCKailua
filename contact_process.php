<?php
/* PHP Form Mailer - phpFormMailer v2.2, last updated 23rd Jan 2008 - check back often for updates!
   (easy to use and more secure than many cgi form mailers) FREE from:
                  www.TheDemoSite.co.uk
      Should work fine on most Unix/Linux platforms
      for a Windows version see: asp.thedemosite.co.uk
*/

// ------- three variables you MUST change below  -------------------------------------------------------
$replyemail="ken.romero@gmail.com";//change to your email address
$valid_ref1="http://cbckailua.com/index.html";// change "Your--domain" to your domain
$valid_ref2="http://www.cbckailua.com/index.html";// change "Your--domain" to your domain
// -------- No changes required below here -------------------------------------------------------------
// email variable not set - load $valid_ref1 page
if (!isset($_POST['email']))
{
 echo "<script language=\"JavaScript\"><!--\n ";
 echo "top.location.href = \"$valid_ref1\"; \n// --></script>";
 exit;
}

$ref_page=$_SERVER["HTTP_REFERER"];
$valid_referrer=0;
if($ref_page==$valid_ref1) $valid_referrer=1;
elseif($ref_page==$valid_ref2) $valid_referrer=1;
if(!$valid_referrer)
{
 echo "<script language=\"JavaScript\"><!--\n alert(\"ERROR - not sent.\\n\\nCheck your 'valid_ref1' and 'valid_ref2' are correct within contact_process.php.\");\n";
 echo "top.location.href = \"index.html\"; \n// --></script>";
 exit;
}

//check user input for possible header injection attempts!
function is_forbidden($str,$check_all_patterns = true)
{
 $patterns[0] = 'content-type:';
 $patterns[1] = 'mime-version';
 $patterns[2] = 'multipart/mixed';
 $patterns[3] = 'Content-Transfer-Encoding';
 $patterns[4] = 'to:';
 $patterns[5] = 'cc:';
 $patterns[6] = 'bcc:';
 $forbidden = 0;
 for ($i=0; $i<count($patterns); $i++)
  {
   $forbidden = eregi($patterns[$i], strtolower($str));
   if ($forbidden) break;
  }
 //check for line breaks if checking all patterns
 if ($check_all_patterns AND !$forbidden) $forbidden = preg_match("/(%0a|%0d|\\n+|\\r+)/i", $str);
 if ($forbidden)
 {
  echo "<font color=red><center><h3>STOP! Message not sent.</font></h3><br><b>
        The text you entered is forbidden, it includes one or more of the following:
        <br><textarea rows=9 cols=25>";
  foreach ($patterns as $key => $value) echo $value."\n";
  echo "\\n\n\\r</textarea><br>Click back on your browser, remove the above characters and try again.
        </b><br><br><br><br>Thankfully protected by phpFormMailer freely available from:
        <a href=\"http://thedemosite.co.uk/phpformmailer/\">http://thedemosite.co.uk/phpformmailer/</a>";
  exit();
 }
 else return $str;
}

$name = is_forbidden($_POST["name"]);
$email = is_forbidden($_POST["email"]);
$thesubject = is_forbidden($_POST["thesubject"]);
$themessage = is_forbidden($_POST["themessage"], false);
console.log($themessage);
$success_sent_msg='<p align="center"><strong>&nbsp;</strong></p>
                   <p align="center"><strong>Your message has been successfully sent to us<br>
                   </strong> and we will reply as soon as possible.</p>
                   <p align="center">A copy of your query has been sent to you.</p>
                   <p align="center">Thank you for contacting us.</p>
				   <p align="center"<a href="index.html">Click here to return to the Custom Built Cabinetry site...</a></p>';

$replymessage = "Hi $name

Thank you for your email.

We will endeavour to reply to you shortly.

Please DO NOT reply to this email.

Below is a copy of the message you submitted:
--------------------------------------------------
Subject: $thesubject
Query:
$themessage
--------------------------------------------------

Thank you";

$themessage = "name: $name \nEmail: $email \nPhone: $phone \nQuery: $themessage";
mail("$replyemail",
     "Custom Built Cabinetry Inquiry...",
     "$themessage",
     "From: $email\nReply-To: $email");
mail("$email",
     "Receipt: $thesubject",
     "$replymessage",
     "From: $replyemail\nReply-To: $replyemail");
echo $success_sent_msg;
/*
  PHP Form Mailer - phpFormMailer (easy to use and more secure than many cgi form mailers)
   FREE from:

    www.TheDemoSite.co.uk       */