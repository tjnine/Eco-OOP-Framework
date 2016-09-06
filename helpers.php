<?php

function Redirect($url, $statusCode = 303) {
	header('Location: ' . $url, true, $statusCode);
	exit();
}

?>