<?php
	session_start();
	if(!isset($_SESSION['id'])){
		echo "<script> location.href = '../index.php' </script>";
	}
?>