<?php
	session_start();
	require '../src/util.php';
	$cfg = parse_ini_file('../src/config.ini');
	
	function attempt() {
		if (missing($_POST['score'])) {
			return '<span class="bad">Missing score!</span>';
		}
		
		if (!$cfg['db_enabled'] || !class_exists('mysqli')) {
			return '<span class="bad">Database functionality not enabled!</span>';
		}
		$mysqli = new mysqli(
			$cfg['db_host'],
			$cfg['db_user'],
			$cfg['db_pass'],
			$cfg['db_name']
		);
		if ($mysqli->connect_errno) {
			return '<span class="bad">Connect error!</span>';
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
			return '<span class="bad">Query error!</span>';
		}
		
		return '<span class="good">Score successfully submitted!</span>';
	}
	
	$msg = attempt();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>? - Score Submission</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div>
		<?=$msg?>
		
	</div>
</body>
