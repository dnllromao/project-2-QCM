<?php
	/* 
	* This one generates the form with right and wrong answers 
	* and shuftle questions and answers
	*/

	// 1. Create array with the data needed to generate quiz
	$questions = [
		array(
			'question' => 'La bonne réponse est A?',
			'answers' => array(
					array(	
						'html' => 'Réponse A',
						'value' => 'a1'
					),
					array(
						'html' => 'Réponse B',
						'value' => 'c'
					),
					array(
						'html' => 'Réponse C',
						'value' => 'a3'
					)
				)
			),
		array(
			'question' => 'La bonne réponse est B?',
			'answers' => array(
					array(	
						'html' => 'Réponse A',
						'value' => 'c'
					),
					array(
						'html' => 'Réponse B',
						'value' => 'b2'
					),
					array(
						'html' => 'Réponse C',
						'value' => 'b3'
					)
				)
			),
		array(
			'question' => 'La bonne réponse est C?',
			'answers' => array(
					array(	
						'html' => 'Réponse A',
						'value' => 'c1'
					),
					array(
						'html' => 'Réponse B',
						'value' => 'c'
					),
					array(
						'html' => 'Réponse C',
						'value' => 'c3'
					)
				)
			)
	];

	require('script.php');
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
		<div class="row">
			<h1 class="text-center"><strong>Take the Quiz</strong></h1>
		</div>
		<hr>
		<form action="" method="post" class="form-horizontal">
			<div class="row">
				<ol class="list">

					<?php
						// 2. Shuftle questions if form is not submited
						// OR take last order of the quiz
						if (empty($_POST)) { shuffle($questions); }
						else { $questions = unserialize($_POST['order']); }

						foreach ($questions as $name => $row) {
						?>
							<li>
								<h4><?= $row['question']?></h4>
								<?php
									// 3. Shuftle answers if form is not submited
									if(empty($_POST)) { shuffle($row['answers']); }

									// $row is a local var and i have to assine this value to principal array . thanks to david 
									$questions[$name] = $row;

									foreach ($row['answers'] as $index => $rep) {

									// 4. witch_class() - return class to show right answers in green and wrong answer in red
									// is_checked - return attribute checked if user has selected that option
									?>
										<div class="radio">
											<label class="<?= witch_class($name, $rep['value']); ?>">
										    	<input type="radio" name="<?= $name; ?>" value="<?= $rep['value'] ?>" <?= is_checked($name, $rep['value']); ?>>
										    	<?= $rep['html']?>
										  	</label>
										</div>
									<?php
									}
								?>
							</li>

						<?php

						}

					?>
				</ol>
				<!-- serialize doesn't work whitout htmlspecialchars(). why ? -->
				<input type="hidden" name="order" value="<?= htmlspecialchars(serialize($questions)); ?>">
				<!-- Send new $questions order to show the same order after page reload -->
			</div>
			<hr>
			<?php
				if(!empty($_POST)) {
				?>
					<div class="row">
						<div class="col-sm-12">
							<div class="alert alert-info" role="alert">
								<p>Tu as réussi <?php echo $count.'/'.count($questions); ?> questions.</p> 
							</div>
						</div>
					</div>
				<?php
				}
			?>
			<div class="well clearfix">
				<div class="row">
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
		</form>
	</div>
</body>
</html>
