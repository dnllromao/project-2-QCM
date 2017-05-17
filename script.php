<?php

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

const RIGTH_ANSWERS = [
	'a' => 'a1',
	'b' => 'b2',
	'c' => 'c3'
];

$count = 0;
// Check right answers
foreach (RIGTH_ANSWERS as $question => $value) {

	if( isset($_GET[$question]) && $_GET[$question] == $value ) {
		$count++;
	}
}

if ( $count < count(RIGTH_ANSWERS) / 2 ) {
	$img = 'https://media.giphy.com/media/l0HlKffnZbKPxPe6Y/giphy.gif';
}elseif ( $count >= (count(RIGTH_ANSWERS) / 2 ) && $count < count(RIGTH_ANSWERS) ) {
	$img = 'https://media.giphy.com/media/3o6Ztp2P0mi36ORkWI/giphy.gif';
}elseif ( $count == count(RIGTH_ANSWERS)) {
	$img = 'https://media.giphy.com/media/26gJygqmJ3QTUn5Ly/giphy.gif';
}

// sanitize last and first name and email validation
$lstName = (!empty($_GET['lst-name']))?sanitization($_GET['lst-name']):'';
$fstName = (!empty($_GET['fst-name']))?sanitization($_GET['fst-name']):'';

$msg = 'Cher <strong>'.$lstName.' '.$fstName.'</strong>, ta note est de <strong class="text-primary bigger">'.$count . '/' . count(RIGTH_ANSWERS).'</strong>';

if( !empty($_GET['email']) && !filter_var(sanitization($_GET['email']), FILTER_VALIDATE_EMAIL) == false){
	$email = filter_var(sanitization($_GET['email']), FILTER_VALIDATE_EMAIL);
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