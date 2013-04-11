<?php
	namespace Tests\Entities;
	use System\Exceptions as Exp;
	use Classes\Entities as Ent;
	use Tests as T;
	
	class TestArticle extends T\AbstractTest {
	
		public function __construct() {}
		
		public function runTests() {
			$toReturn  = "<h3> TESTS: Entity - Article </h3>";
			$toReturn .= $this->test_if_article_even_loads();
			$toReturn .= $this->test_check_updated_status_is_set_correctly();
			return $toReturn;
		}
		
		private function test_if_article_even_loads() {
			try {
				$article = new Ent\Article();
				return T\AbstractTest::assertNotNull($article, "Article was null");
			} catch(Exp\TestException $e) {
				return $e->getMessage();
			}
		}
		
		private function test_check_updated_status_is_set_correctly() {
			try {
				$article = new Ent\Article();
				T\AbstractTest::assertFalse($article->getUpdated(), "Updated was true", 1);
				$article->setUpdated(true);
				T\AbstractTest::assertTrue($article->getUpdated(), "Updated was false", 1);
				$article->setUpdated(false);
				return T\AbstractTest::assertFalse($article->getUpdated(), "Updated was true 3", 1);
			} catch(Exp\TestException $e) {
				return $e->getMessage();
			}
		}
	}
?>