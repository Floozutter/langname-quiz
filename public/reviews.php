<?php
	session_start();
	require '../src/util.php';
	$cfg = parse_ini_file('../src/config.ini');
	
	function print_results() {
		global $cfg;
		
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
			' 	review.id,' .
			' 	review.content,' .
			' 	user.name' .
			' FROM' .
			' 	review' .
			' 	LEFT JOIN user' .
			' 		ON review.user_id = user.id' .
			' ORDER BY review.id DESC;'
		);
		$results = $mysqli->query($query);
		if (!$results) {
			echo '<span class="text-danger">Query error!</span>';
			return;
		}
		
		echo '<ul class="list-group list-group-flush">';
		while ($row = $results->fetch_assoc()) {
			echo '<li class="list-group-item">';
			echo '<blockquote class="blockquote">';
			echo '<p>' . $row['content'] . '</p>';
			echo '<footer class="blockquote-footer">' . (empty($row['name']) ? '<span class="font-italic text-muted">Anonymous</span>' : $row['name']) . '</footer>';
			echo '</blockquote>';
			if (empty($row['name'])) {
				$id = $row['id'];
				$href = "'reviews-delete.php?id={$id}'";
				echo '<button type="button" onclick="location.href=' . $href . ';" class="btn btn-danger">Delete</button>';
			}
			echo '</li>';
		}
		echo '</ul>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Langalike - Reviews</title>
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
				<li class="nav-item">
					<a class="nav-link" href="scoreboard.php">Scoreboard</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="reviews.php">Reviews<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="user.php">User</a>
				</li>				
			</ul>
		</div>
	</nav>
	<div class="container align-items-center justify-content-center">
		<div class="card mx-auto my-4">
			<div id="coller" class="card-header text-center display-4 text-primary collapsed" data-toggle="collapse" href="#colly" aria-expanded="false" aria-controls="colly">
				Write a Review
			</div>
			<div id="colly" class="card-body lead collapse" role="tabpanel" aria-labelledby="coller" style="padding: 0;">
				<div style="padding: 20px;">
					<p>Writing as "<?php echo (empty($_SESSION['user-name']) ? '<span class="font-italic text-muted">Anonymous</span>' : $_SESSION['user-name']); ?>":</p>
					<form action="reviews-submit.php" method="POST">
						<input type="hidden" name="user_id" value="<?=$_SESSION['user-id']?>">
						<div class="form-group">
							<textarea id="content-id" name="content" class="form-control" rows="3" placeholder="cool very"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
			<div class="card-footer text-muted">
				uwu
			</div>
		</div>
		<div id="board" class="card mx-auto my-4">
			<div class="card-header text-center display-4">
				Reviews
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