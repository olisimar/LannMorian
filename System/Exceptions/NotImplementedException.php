<?php
	namespace System\Exceptions;
	/**
	 * Use when a feature is left hanging due to code.
	 */
	class NotImplementedException extends BaseException {
		
		public function __construct($mess,$code=1,$previous=null) {
			parent::__construct($mess,$code,$previous);
		}
	}
?>