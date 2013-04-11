<?php
	namespace Tests;
	use System\Exceptions AS Exp;
	use Tests\Entities as TE;
	
	class TestExceptions {
	
		public function __construct() {}
		
		public function runTests() {
			$toReturn = "";
			$toReturn .= $this->testBaseExceptionDoesPrintOut();
			$toReturn .= $this->testEntities();
			return $toReturn;
		}
		
		private function testBaseExceptionDoesPrintOut() {
			try {
				throw new Exp\BaseException("First Message", "1");
			} catch(Exp\BaseException $e1) {
				try{
					throw new Exp\BaseException("Second Message", "2", $e1);
				} catch(Exp\BaseException $e2) {
					try{
						throw new Exp\ValidationException("Third Message", "33333333", $e2);
					} catch(Exp\BaseException $e2) {
						echo $e2->getTraceAsHtml();
					}
				}
			}
		}
		
		private function testEntities() {
			$testArticle = new TE\TestArticle();
			$toReturn  = "";
			$toReturn .= $testArticle->runTests();
			return $toReturn;
		}
	}
	
?>