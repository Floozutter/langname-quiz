<?php
function missing($var) {
	return !isset($var) || empty($var);
}
function null_fallback($var) {
	return (
		missing($var)
		? 'NULL'
		: $var
	);
}
function null_fallback_quoted($var) {
	return (
		missing($var)
		? 'NULL'
		: '\'' . $var . '\''
	);
}