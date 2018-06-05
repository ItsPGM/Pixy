<?php
session_start();
var_dump($_SESSION);

if (!empty($_SESSION)) {
	session_destroy();
	header("Location: index.php");
}
?>