<?php

	$interations = 0;
	$count = 0;

	function witch_class($name,$value) {

		if(empty($_GET))
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
		if( isset($_GET[$name]) && $value == $_GET[$name])
			return 'checked';
	}

	function how_many() {
		global $interations;
		$interations++;
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
	$lstName = (!empty($_GET['lst-name']))?sanitization($_GET['lst-name']):'';
	$fstName = (!empty($_GET['fst-name']))?sanitization($_GET['fst-name']):'';

	if( !empty($_GET['email']) && !filter_var(sanitization($_GET['email']), FILTER_VALIDATE_EMAIL) == false){
		$email = filter_var(sanitization($_GET['email']), FILTER_VALIDATE_EMAIL);
		sendMail($email, $msg);
	}
