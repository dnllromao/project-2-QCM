<?php
	
		$interation = 0;
		$count = 0;

		function witch_class($name,$value) {

			if(!isset($_GET[$name])) 
				return;

			global $interation;
			global $count;

			$interation ++;

			if( $value == 'c') {
				if(is_checked($name,$value)) { $count ++; }
				return 'green';
			}else if( is_checked($name,$value)) {
				// return 'checked';
				return 'red';
			}
		}

		function is_checked($name,$value) {
			if( $value == $_GET[$name])
				return 'checked';
		}

		echo $interation;
		echo $count;

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QCM</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!--<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">-->
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
<!-- 		<div class="col-sm-10"></div> -->
		<div class="row">
			<h1 class="text-center"><strong>Take the Quiz</strong></h1>
		</div>
		<hr>
		<form action="" method="get" class="form-horizontal">
			<div class="row">
				<ol class="list">
					<li>
						<h4>La bonne réponse est A?</h4>
						<div class="radio">
							<label class="<?= witch_class('a','a1'); ?>">
						    	<input type="radio" name="a" value="a1" <?= is_checked('a', 'a1'); ?>>
						    	Réponse A
						  	</label>
						</div>
						<div class="radio">
							<label class="<?= witch_class('a','c'); ?>">
						    	<input type="radio" name="a" value="c" <?= is_checked('a', 'c'); ?>>
						    	Réponse B
						  	</label>
						</div>
						<div class="radio">
							<label class="<?= witch_class('a','a3'); ?>">
						    	<input type="radio" name="a" value="a3" <?= is_checked('a', 'a3'); ?>>
						    	Réponse A
						  	</label>
						</div>
						<input type="hidden" name="a-r" value="a1">
					</li>
					<li>
						<h4>La bonne réponse est B?</h4>
						<div class="radio">
							<label>
						    	<input type="radio" name="b" value="b1">
						    	Réponse A
						  	</label>
						</div>
						<div class="radio">
							<label>
						    	<input type="radio" name="b" value="b2">
						    	Réponse B
						  	</label>
						</div>
						<div class="radio">
							<label>
						    	<input type="radio" name="b" value="b3">
						    	Réponse A
						  	</label>
						</div>
						<input type="hidden" name="b-r" value="b1">
					</li>
					<li>
						<h4>La bonne réponse est C?</h4>
						<div class="radio">
							<label>
						    	<input type="radio" name="c" value="c1">
						    	Réponse A
						  	</label>
						</div>
						<div class="radio">
							<label>
						    	<input type="radio" name="c" value="c2*">
						    	Réponse B
						  	</label>
						</div>
						<div class="radio">
							<label>
						    	<input type="radio" name="c" value="c3">
						    	Réponse A
						  	</label>
						</div>
						<input type="hidden" name="c-r" value="c1">
					</li>
				</ol>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<div class="well clearfix">
						<div class="col-md-6">
							<div class="form-group">
							    <label for="lst-name" class="col-sm-2 control-label">Nom</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="lst-name" name="lst-name">
							    </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							    <label for="fst-name" class="col-sm-2 control-label">Prénom</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="fst-name" name="fst-name">
							    </div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
							    <label for="email" class="col-sm-2 col-md-1 control-label">Email</label>
							    <div class="col-sm-10 col-md-11">
							      <input type="email" class="form-control" id="email" name="email">
							    </div>
							</div>
							<div class="form-group">
							    <div class="col-sm-offset-2 col-md-offset-1 col-sm-10 col-md-11">
							      <button type="submit" class="btn btn-primary">Finish</button>
							    </div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</form>
	</div>
</body>
</html>
<?php
	echo $interation;
	echo $count;
?>