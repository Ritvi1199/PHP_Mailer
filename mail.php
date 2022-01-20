<?php
$conn = mysqli_connect("localhost","root","","mailer");
require 'PHPMailerAutoload.php';


//Setup 


$mail=new PHPMailer;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'ritvishrivastav@gmail.com';                     //SMTP username
$mail->Password   = '***********';                               //SMTP password
$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('ritvishrivastav@gmmail.com');
$sql = "select * from users where sendemail=1";
$res =mysqli_query($conn,$sql);
if(mysqli_num_rows($res)>0)
{

                 
    $mail->addReplyTo('ritvishrivastav@gmail.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    while($x=mysqli_fetch_assoc($res))
    {
        $mail->addBCC($x['email']);
    }
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'This is a demo email';
    $mail->Body    = '<h1> Hello Everyone </h1>';
    $mail->AltBody = 'This is for non html content';
    if($mail->send())
    {
     echo "Successfully send";
    }
    else
    {
        echo "Fail to send";
    }




}



?>