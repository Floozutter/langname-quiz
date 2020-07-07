<?php
$str = file_get_contents('../resources/quiz.json');
$json = json_decode($str, true);

if (isset($_GET['count'])) {
	echo count($json['quiz']);
} elseif (isset($_GET['question'])) {
	$question = $json['quiz'][(int)$_GET['question']];
	for ($i = 0; $i < count($question['choices']); $i++) {
		unset($question['choices'][$i]['correct']);
		unset($question['choices'][$i]['explain']);
	}
	echo json_encode($question);
} elseif (isset($_GET['full'])) {
	echo json_encode($json['quiz'][(int)$_GET['full']]);
}