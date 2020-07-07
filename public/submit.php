<?php
	session_start();
	echo $_SESSION['latest-score'];
	echo $_SESSION['latest-time'];
	echo $_SESSION['latest-logged'] ? 'true' : 'false';
?>