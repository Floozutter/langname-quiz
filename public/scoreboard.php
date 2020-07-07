<?php
	session_start();
	require '../src/util.php';
	$cfg = parse_ini_file('../src/config.ini');
	
	function print_results() {
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
		
		$query = (
			' SELECT' . 
			' 	user.name,' .
			' 	score.value,' .
			' 	score.time,' .
			' 	score.comment' .
			' FROM' .
			' 	score' .
			' 	LEFT JOIN user' .
			' 		ON score.user_id = user.id' .
			' ORDER BY score.time DESC'
		);
		$results = $mysqli->query($query);
		if (!$results) {
			echo '<span class="text-danger">Query error!</span>';
			return;
		}
		
		echo '<table class="table table-hover table-responsive">';
		echo '<thead><tr><th>User</th><th>Score</th><th>Time</th><th>Comment</th></tr></thead>';
		echo '<tbody>';
		while ($row = $results->fetch_assoc()) {
			echo '<tr>';
			echo '<td>' . $row['name'] . '</td>';
			echo '<td>' . $row['value'] . '</td>';
			echo '<td>' . $row['time'] . '</td>';
			echo '<td>' . $row['comment'] . '</td>';
			echo '</tr>';
		}
		echo '<tbody>';
		echo '</table>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Langalike - Scoreboard</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/board.css">
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
					<a class="nav-link" href="index.php">Quiz</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.php">About</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="scoreboard.php">Scoreboard<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="scoreboard.php">User</a>
				</li>				
			</ul>
		</div>
	</nav>
	<div class="container align-items-center justify-content-center">
		<div id="board" class="card mx-auto my-4">
			<div class="card-header text-center display-4">
				Scoreboard
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