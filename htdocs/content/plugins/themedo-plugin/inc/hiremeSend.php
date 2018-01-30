<?php

// Put contacting email here
$main_email = $_POST['xx_receiver'];


//Fetching Values from URL
$name = $_POST['xx_name'];
$email = $_POST['xx_email'];
$date = $_POST['xx_date'];
$time = $_POST['xx_time'];
$message = $_POST['xx_message'];
$contact = $_POST['xx_contact'];


//Sanitizing email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);


//After sanitization Validation is performed
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	
	if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $contact)) { // 
		echo "<span class='book_error'>* Please Fill Valid Contact No. *</span>";
	} else {
		$subject = "Reservation";
		
		// To send HTML mail, the Content-type header must be set
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:' . $email. "\r\n"; // Sender's Email
		
		$template = '<div style="padding:50px;">'
		//. 'Thank you...! For Contacting Us.<br/><br/>'
		. '<strong style="color:#8b6e40;">Name:</strong>  ' . $name . '<br/>'
		. '<strong style="color:#8b6e40;">Email:</strong>  ' . $email . '<br/>'
		. '<strong style="color:#8b6e40;">Contact No:</strong>  ' . $contact . '<br/>'
		. '<strong style="color:#8b6e40;">Date:</strong>  ' . $date . '<br/>'
		. '<strong style="color:#8b6e40;">Time:</strong>  ' . $time . '<br/><br/>'
		. '<strong style="color:#8b6e40;">Message:</strong>  ' . $message . '<br/><br/>'
		. '</div>';
		$sendmessage = "<div style=\"background-color:#f5f5f5; color:#333; line-height:1.8; letter-spacing:0.5px; font-size:15px;\">" . $template . "</div>";
		
		// message lines should not exceed 70 characters (PHP rule), so wrap it
		$sendmessage = wordwrap($sendmessage, 70);
		
		// Send mail by PHP Mail Function
		mail($main_email, $subject, $sendmessage, $headers);
		echo "";
	}
	
} else {
	echo "<span class='book_error'>* Invalid email *</span>";
}

?>