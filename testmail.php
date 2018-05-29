<?php
$from='training@selfpacedtech.com';
$headers .= 'From: '.$from."\r\n".

    'Reply-To: '.$from."\r\n" .

    'X-Mailer: PHP/' . phpversion();
if(mail('krishna.kkarthi@gmail.com', 'Test', 'TEST', $headers)){

    echo 'Your mail has been sent successfully.';

} else{

    echo 'Unable to send email. Please try again.';

}
?>