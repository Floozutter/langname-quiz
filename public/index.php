<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Langalike</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/quiz.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script defer src="js/ajax.js"></script>
	<script defer src="js/quiz.js"></script>
	<script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body id="override">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="index.php">Langalike</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Quiz<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.php">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="scoreboard.php">Scoreboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="reviews.php">Reviews</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="user.php">User</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container align-items-center justify-content-center">
		<div id="quiz" class="card mx-auto my-4">
			<div class="card-header text-center display-4">
				Langalike
			</div>
			<div class="card-body">
				<div id="prompt" class="card-title mb-4 lead">
					<p>
						Hi! Welcome to Langalike, the quiz which tests your ability to distinguish real programming language names from fake ones.
					</p>
					<p>
						Use the button below to start the quiz!
					</p>
				</div>
				<div id="choices" class="list-group"></div>
				<div class="mt-4">
					<button id="butty" type="button" disabled class="btn btn-primary">Continue</button>
				</div>
			</div>
			<div class="card-footer text-muted">
				Progress: <span id="progress">0 of ?</span>&emsp;|&emsp;Score: <span id="score">0</span>
			</div>
		</div>
	</div>
</body>