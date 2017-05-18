<?php

 // next time try filter_input_array() !!
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

// 1. Create array with the right answer's choice
const RIGTH_ANSWERS = [
	'a' => 'a1',
	'b' => 'b2',
	'c' => 'c3'
];

// 2. Start var that count how many answers are right
$count = 0;

// 3. Check which answers are right
foreach (RIGTH_ANSWERS as $question => $value) {

	if( isset($_POST[$question]) && $_POST[$question] == $value ) {
		$count++;
	}
}

// 4. Select a gif in relation to quiz result
if ( $count < count(RIGTH_ANSWERS) / 2 ) {
	$img = 'https://media.giphy.com/media/l0HlKffnZbKPxPe6Y/giphy.gif';
}elseif ( $count >= (count(RIGTH_ANSWERS) / 2 ) && $count < count(RIGTH_ANSWERS) ) {
	$img = 'https://media.giphy.com/media/3o6Ztp2P0mi36ORkWI/giphy.gif';
}elseif ( $count == count(RIGTH_ANSWERS)) {
	$img = 'https://media.giphy.com/media/26gJygqmJ3QTUn5Ly/giphy.gif';
}

// 5. Sanitize last and first name
$lstName = (!empty($_POST['lst-name']))?sanitization($_POST['lst-name']):'';
$fstName = (!empty($_POST['fst-name']))?sanitization($_POST['fst-name']):'';

// 6. Create message to show
$msg = 'Cher <strong>'.$lstName.' '.$fstName.'</strong>, ta note est de <strong class="text-primary bigger">'.$count . '/' . count(RIGTH_ANSWERS).'</strong>';


// 7. Sanitize and validate email + sending email if everthing is good
if( !empty($_POST['email']) && !filter_var(sanitization($_POST['email']), FILTER_VALIDATE_EMAIL) == false){
	$email = filter_var(sanitization($_POST['email']), FILTER_VALIDATE_EMAIL);
	sendMail($email, $msg);
} else {
	$email = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QCM - result</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!--<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">-->
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div class="row centered-child window-height">
			<div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-heading">
				  	<h2 class="panel-title">
				  	<?= $msg; ?>
				  	</h2>
				  </div>
				  <div class="panel-body text-center">
				  	<img src="<?= $img; ?>" alt="..." class="img-responsive">
				  </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>