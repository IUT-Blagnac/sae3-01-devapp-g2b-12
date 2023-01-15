<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<input type="file" name="image">
		<input type="submit">
	</form>
</body>
</html>
<?php
	if (!empty($_FILES["image"])) {

		$image = $_FILES["image"];

		if ($image["error"] == 0) {
			echo "whoami : ".exec("whoami")."<br>";
			echo "pwd : ".exec("pwd")."<br>";
			echo "ls -l | grep imgtest : ".exec("ls -l | grep imgtest")."<br>";
			echo "ls -l .. | grep dossier : ".exec("ls -l .. | grep dossier")."<br>";
			echo "touch imgtest/test : ".exec("touch imgtest/test")."<br>";
			move_uploaded_file($image["tmp_name"], "imgtest/test.jpg");
		}
	}
?>
