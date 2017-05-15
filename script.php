<?php

const RIGTH_ANSWERS = [
	'a' => 'a1',
	'b' => 'b2',
	'c' => 'c3'
];
//var_dump($_GET);
$count = 0;

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QCM - result</title>
	<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div class="row centered-child window-height">
			<div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-heading">
				  	<h2 class="panel-title">
				  	Cher <strong><?= (($_GET['fst-name'])?$_GET['fst-name']:'').' '.(($_GET['lst-name'])?$_GET['lst-name']:''); ?></strong>, ta note est de <strong class="text-primary bigger"><?php echo $count . '/' . count(RIGTH_ANSWERS); ?></strong>
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