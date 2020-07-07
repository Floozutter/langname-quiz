<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>? - Quiz</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/quiz.css">
	<script defer src="js/ajax.js"></script>
	<script defer src="js/quiz.js"></script>
</head>
<body>
	<div id="quiz">
		<div id="prompt">
			Hello, World!
		</div>
		<div id="choices"></div>
		<button id="butty" type="button" disabled>Next</button>
		<div id="progress"></div>
	</div>
</body>