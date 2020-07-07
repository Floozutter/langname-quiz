<?php
	session_start();
	
	$anon = !isset($_SESSION['user-id']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Langalike - User</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
				<li class="nav-item">
					<a class="nav-link" href="index.php">Quiz</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.php">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="scoreboard.php">Scoreboard</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="scoreboard.php">User<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container align-items-center justify-content-center">
		<div class="card mx-auto my-4">
			<div class="card-header text-center display-4">
				User
			</div>
			<div class="card-body lead">
				<?php if ($anon) { ?>
					<h4 class="card-title">Create Account:</h4>
					<form action="user-new.php" method="POST">
						<div class="form-group">
							<label for="newname-id">Username: </label>
							<input type="text" id="newname-id" name="newname" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary">Create</button>
					</form>
					<hr>
					<h4 class="card-title">Sign In:</h4>
					<form action="user-in.php" method="POST">
						<div class="form-group">
							<label for="name-id">Username: </label>
							<input type="text" id="name-id" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="secret-id">Secret: </label>
							<input type="text" id="secret-id" name="secret" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary">Sign In</button>
					</form>
				<?php } else { ?>
					<h4 class="card-title">You're signed in as <?=$_SESSION['user-name']?>.</h4>
					<form action="user-out.php">
						<button type="submit" class="btn btn-primary">Sign Out</button>
					</form>
				<?php } ?>
			</div>
			<div class="card-footer text-muted">
				uwu
			</div>
		</div>
	</div>
</body>

