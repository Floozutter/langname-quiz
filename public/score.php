<?php
	session_start();
	
	if (empty($_SESSION['latest-score'])) {
		$err = true;
		$errmsg = 'No score found!';
	} else if ($_SESSION['latest-logged']) {
		$err = true;
		$errmsg = 'Score already submitted!';
	} else {
		$err = false;
		$errmsg = '';
	}
	
	$name = (
		isset($_SESSION['user-id'])
		? $_SESSION['user-name']
		: 'Anonymous'
	);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Langalike - Submit Score?</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body id="override">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="/">Langalike</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="/">Quiz</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.php">About</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container align-items-center justify-content-center">
		<div class="card mx-auto my-4">
			<div class="card-header text-center display-4">
				Submit Your Score?
			</div>
			<div class="card-body lead">
				<div id="error" class="mb-2 text-danger">
					<?=$errmsg?>
				</div>
				<form action="score-submit.php" method="POST">
					<input type="hidden" name="user_id" value="<?=$_SESSION['user-id']?>">
					<input type="hidden" name="time" value="<?=$_SESSION['latest-time']?>">
					<div class="form-group">
						<label for="name-id">Name:</label>
						<input type="text" id="name-id" class="form-control" value="<?=$name?>" readonly="readonly">
					</div>
					<div class="form-group">
						<label for="score-id">Score:</label>
						<input type="number" id="score-id" class="form-control" name="score" value="<?=$_SESSION['latest-score']?>" readonly="readonly">
					</div>
					<div class="form-group">
						<label for="text-id">Comment:</label>
						<input type="text" id="text-id" class="form-control" name="comment" placeholder="very cool">
					</div>
					<button type="submit" class="btn btn-primary" <?php if($err){echo 'disabled';}?>>Submit</button>
				</form>
			</div>
			<div class="card-footer text-muted">
				uwu
			</div>
		</div>
	</div>
</body>
