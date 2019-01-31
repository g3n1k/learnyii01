<?php
if(isset($_POST['submit']) && !empty($_POST['submit'])):
    
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key
        $secret = '6Leln9MSAAAAAEf_Nzv0xq_NeFjneHIex6QcQsQA';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success):
        
            //contact form submission code
            $name = !empty($_POST['name'])?$_POST['name']:'';
            $email = !empty($_POST['email'])?$_POST['email']:'';
            $message = !empty($_POST['message'])?$_POST['message']:'';
            
            
            $addr_reply = $name.'<'.$email.'>';
            
			$to = "indra.sadik@gmail.com";
			$subject = "Form website";
			$headers = 'From: '.$addr_reply."\r\n" .
			     'Reply-To: '.$addr_reply."\r\n";

			
			mail($to,$subject,$message,$headers);
           
            
            $succMsg = 'Your contact request have submitted successfully.' . $result;
        else:
            $errMsg = 'Robot verification failed, please try again.';
        endif;
    else:
        $errMsg = 'Please click on the reCAPTCHA box.';
    endif;
else:
    $errMsg = '';
    $succMsg = '';
endif;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	
	<div><?php echo $errMsg;?></div>
	<div><?php echo $succMsg;?></div>
	<form action="" method="POST">
		name<br />
		<input type="text" name="name" value="" /><br />
		email<br />
		<input type="text" name="email" value="" /><br />
		message<br />
		<textarea type="text" name="message"></textarea><br />
		<br />
		<div class="g-recaptcha" data-sitekey="6Leln9MSAAAAAMHFLnJeTGul22k9urc7OJ5KMWnw"></div>
		<br />
		<input type="submit" name="submit" value="SUBMIT">
	</form>
	
</body>

</html> 
