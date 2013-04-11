<?php
	namespace System\Exceptions;
	
	class ValidationException extends BaseException {
		public function __construct($mess, $code=0, $previous=null) {
			parent::__construct($mess, $code, $previous);
		}
	}
?>