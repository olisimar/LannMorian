<?php
	$dir = str_replace("Tests", "",__DIR__) .'bootstrap.php';
	require_once($dir);
	
	echo 'Suite is running...<br/>';
	try {
		$suite = new Tests\TestSuite();
		echo $suite->runTests();
	} catch(ErrorException $e) {
		echo $e->getMessage() ."<br />";
		echo $e->getTraceAsString();
	}
	
	echo '<br />Done...';
?>