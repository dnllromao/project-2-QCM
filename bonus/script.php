<?php

	$count = 0;

	function witch_class($name,$value) {

		if(empty($_POST))
			return;

		global $count;

		if( $value == 'c') {
			if(is_checked($name,$value)) { $count ++; }
			return 'text-success';
		}else if( is_checked($name,$value)) {
			return 'text-danger';
		}
	}

	function is_checked($name,$value) {
		if( isset($_POST[$name]) && $value == $_POST[$name])
			return 'checked';
	}

	function sanitization($data) {
		$data = trim($data); // Strip whitespace
	    $data = strip_tags($data); // 
		$data = stripslashes($data); // Remove the backslash
		$data = htmlspecialchars($data); // Convert special characters to HTML entities
		return $data;
	}

	function sendMail($to,$message) {
		$sujet = 'Résultats du quizz';
		$header = 'Bcc: ton@email.com';
		return mail($to, $sujet, $message, $header);
	}

	// sanitize last and first name and email validation
	$lstName = (!empty($_POST['lst-name']))?sanitization($_POST['lst-name']):'';
	$fstName = (!empty($_POST['fst-name']))?sanitization($_POST['fst-name']):'';

	if( !empty($_POST['email']) && !filter_var(sanitization($_POST['email']), FILTER_VALIDATE_EMAIL) == false){
		$email = filter_var(sanitization($_POST['email']), FILTER_VALIDATE_EMAIL);
		sendMail($email, $msg);
	}
