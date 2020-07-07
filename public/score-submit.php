<?php
	session_start();
	require '../src/util.php';
	$cfg = parse_ini_file('../src/config.ini');
	
	function attempt() {
		if (missing($_POST['score'])) {
			return '<span class="text-danger">Missing score!</span>';
		}
		
		if (!$cfg['db_enabled'] || !class_exists('mysqli')) {
			return '<span class="text-danger">Database functionality not enabled!</span>';
		}
		$mysqli = new mysqli(
			$cfg['db_host'],
			$cfg['db_user'],
			$cfg['db_pass'],
			$cfg['db_name']
		);
		if ($mysqli->connect_errno) {
			return '<span class="text-danger">Connect error!</span>';
		}
		
		$score = null_fallback($_POST['score']);
		$time = null_fallback($_POST['time']);
		$user_id = null_fallback($_POST['user_id']);
		$comment = null_fallback_quoted($_POST['time']);
		
		$query = (
			' INSERT INTO score (' .
			' 	value,' .
			' 	time,' .
			' 	user_id,' .
			' 	comment' .
			' ) VALUES (' .
			" 	$score," .
			" 	$time," .
			" 	$user_id," .
			" 	$comment," .
			' );'
		);
		$results = $mysqli->query($query);
		if (!$results) {
			return '<span class="text-danger">Query error!</span>';
		}
		
		return '<span class="text-success">Score successfully submitted!</span>';
	}
	
	$msg = attempt();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Langalike - Score Submission</title>
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
					<a class="nav-link" href="/">Quiz</span></a>
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
				Score Submission
			</div>
			<div class="card-body lead">
				<?=$msg?>
			</div>
			<div class="card-footer text-muted">
				uwu
			</div>
		</div>
	</div>
</body>