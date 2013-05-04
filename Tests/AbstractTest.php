<?php
	namespace Tests;
	use System\Exceptions as Exp;
	use Classes\Interfaces as CI;
	
	class AbstractTest {
		
		public static function assertTrue($arg, $mess="No Message. Value in: ") {
		$codes = AbstractTest::getCodes();
			if($arg) {
				return $codes['passed'] . $mess;
			}
			throw new Exp\TestException( $codes['failed'] . " Argument was True when Expected to be True " . $arg);
		}
		
		public static function assertFalse($arg, $mess="No Message. Value in: ") {
			$codes = AbstractTest::getCodes();
			if($arg) {
				throw new Exp\TestException( $codes['passed'] . " Argument was True when Expected to be False " . $arg);
			}
			return $codes['passed'] . $mess;
		}
		
		public static function assertEqual($arg1, $arg2, $mess="No Message. Values in: ") {
			$codes = AbstractTest::getCodes();
			if(($arg1 instanceof CI\Comparable) & ( $arg2 instanceof CI\Comparable)) {
				if($arg1->compare($arg2)) {
					return $codes['passed'] . $mess;
				}
			} else  if($arg1 == $arg2) {
				return $codes['passed'] . $mess . $arg1 ." ". $arg2;
			}
			throw new Exp\TestException( $codes['failed'] . "Arguemnts were not equal.");
		}
		
		public static function assertNotNull($arg, $mess="No Message. Value in was not NULL.") {
			$codes = AbstractTest::getCodes();
			if(is_null($arg)) {
				throw new Exp\TestException($codes['failed'] . " Argument was NULL.");
			}
			return $codes['passed'] . $mess;
		}
		
		public static function assertNull($arg, $mess="No Message. Value in was NULL.") {
			$codes = AbstractTest::getCodes();
			if(is_null($arg)) {
				return $codes['passed'] . $mess;
			}
			throw new Exp\TestException($codes['failed'] . " Argument was not NULL.");
		}
		
		private static function getCodes() {
			return array("failed" => "<br /> <span style='color:#A00;'>FAILED</span> : ", "passed" => "<br /><span style='color:#0A0;'>PASSED</span> : ");
		}
	}
?>