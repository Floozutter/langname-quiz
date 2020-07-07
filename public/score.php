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
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>? - Score</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div>
		<form action="score-submit.php" method="POST">
			<input type="hidden" name="user_id" value="<?=$_SESSION['user-id']?>">
			<input type="hidden" name="time" value="<?=$_SESSION['latest-time']?>">
		
			<label for="score-id">Score:</label>
			<input type="number" id="score-id" name="score" value="<?=$_SESSION['latest-score']?>" readonly="readonly">
			
			<label for="text-id">Comment:</label>
			<input type="text" id="text-id" name="comment" placeholder="very cool">
			
			<button type="submit">Submit</button>
		</form>
	</div>
</body>
