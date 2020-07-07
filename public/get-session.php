<?php
session_start();

if (isset($_GET['score']) && ctype_digit($_GET['score'])) {
	$_SESSION['latest-score'] = (int) $_GET['score'];
	$_SESSION['latest-time'] = time();
	$_SESSION['latest-logged'] = false;
}