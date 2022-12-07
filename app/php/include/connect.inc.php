<?php
	$user = 'saesys12';
	$pwd = '';

	try {
		$conn = new PDO('mysql:host=localhost;dbname='.$user.';charset=UTF8', $user, $pwd);
	} catch (PDOException $e) {
		echo '<p>Erreur : '.$e->getMessage().'</p>';
	}
?>
