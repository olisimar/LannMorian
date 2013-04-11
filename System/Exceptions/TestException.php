<?php
	namespace System\Exceptions;
	
	class TestException extends BaseException {
		
		public function __construct($mess, $code=1, $previous=null) {
			parent::__construct($mess, $code, $previous);
		}
	}
?>