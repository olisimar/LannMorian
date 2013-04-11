<?php
	$basedir = str_replace("API", "",__DIR__);
	$dir = str_replace("API", "",__DIR__) .'bootstrap.php';
	require_once($dir);

	echo 'Running<br />';
	echo print_r($_FILES, true);
	
	foreach($_FILES AS $file) {
		if($file['error'] == UPLOAD_ERR_OK) {
			saveFile($file, $basedir);
		} else {
			echo $file['name'] ." - ". $file['error'] ."<br />";
		}
	}

	function saveFile($file, $basedir) {
			$tmp_name = $file['tmp_name'];
			$name = $file['name'];
			move_uploaded_file($tmp_name, "$basedir/Gallery/$name");
	}
	/*
			if ($error == UPLOAD_ERR_OK) {
			$tmp_name = $_FILES["myfile"]["tmp_name"][$file];
			$name = $_FILES["myfile"]["name"][$file];
			move_uploaded_file($tmp_name, "$basedir/Gallery/$name");
			echo $basedir ."/Gallery/$name";
		} else {
			echo $error ." - ". $_FILES["myfile"]["name"][$file];
		}
	*/
?>