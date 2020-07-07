<?php
	session_start();
	require '../src/util.php';
	$cfg = parse_ini_file('../src/config.ini');
	
	function print_results() {
		global $cfg;
		
		if (missing($_POST['name'])) {
			echo '<span class="text-danger">Missing username!</span>';
			return;
		}
		if (missing($_POST['secret'])) {
			echo '<span class="text-danger">Missing secret!</span>';
			return;
		}
		
		if (!$cfg['db_enabled'] || !class_exists('mysqli')) {
			echo '<span class="text-danger">Database functionality not enabled!</span>';
			return;
		}
		$mysqli = new mysqli(
			$cfg['db_host'],
			$cfg['db_user'],
			$cfg['db_pass'],
			$cfg['db_name']
		);
		if ($mysqli->connect_errno) {
			echo '<span class="text-danger">Connect error!</span>';
			return;
		}
		
		$name = $_POST['name'];
		$secret = $_POST['secret'];
		$query = "SELECT id, name FROM user WHERE user.name = '$name' AND user.secret = '$secret';";
		$results = $mysqli->query($query);
		if (!$results) {
			echo '<span class="text-danger">Query error!</span>';
			return;
		}
		
		if ($results->num_rows !== 1) {
			echo '<span class="text-danger">User with secret not found!</span>';
			return;
		}
		
		$user = $mysqli_result->fetch_assoc();
		
		$_SESSION['user-id'] = $user['id'];
		$_SESSION['user-name'] = $user['name'];
		
		echo '<div class="text-success">Successfully signed in!</div>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Langalike - Sign In</title>
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
				<li class="nav-item">
					<a class="nav-link" href="scoreboard.php">User</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container align-items-center justify-content-center">
		<div class="card mx-auto my-4">
			<div class="card-header text-center display-4">
				Sign In
			</div>
			<div class="card-body lead">
				<?php print_results(); ?>
				
			</div>
			<div class="card-footer text-muted">
				uwu
			</div>
		</div>
	</div>
</body>