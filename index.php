<?php
	require_once './bootstrap.php';
	
	try {
		$test = new Tests\Test();
		$sys = System\Sys::getInstance();
		$test->printHi();
		$DB = $sys->getDB();
	} catch(Exception $e) {
		echo $e->getTraceAsString();
		echo "<hr />";
	} catch(ErrorException $e) {
		echo $e->getTraceAsString();
		echo "<hr />";
	}
	
// 	throw new Exception("lambed", 5);
	echo '<br />Done';
?>