<?php
	namespace Tests;
	
	class TestSuite {
		private $test = null;
		
		public function __construct() {
			$this->test = new Test();
		}
		
		public function printHi() {
			if($this->test != null) {
				return $this->test->printHi();
			} else {
				return 'Crap';
			}
		}
		
		public function runTests() {
			$testExceptions = new TestExceptions();
			return $testExceptions->runTests();
		}
	}
?>