<?php
	namespace System;
	
	/**
	 * This class has one purpose, validate the offered input to see if it
	 * is the expected kind and properly formatted. Some validators may be
	 * 'chained' in order to provide a effective and correct answer.
	 */
	class Validator {
	
		/**
		 * Validate an email address.
		 * Provide email address (raw input)
		 * Returns true if the email address has the email address format and the domain exists.
		 */
		public function isEmail($email) {
			$isValid = true;
			$atIndex = strrpos($email, "@");
			if(is_bool($atIndex) && !$atIndex) {
					$isValid = false;
			} else {
					$domain = substr($email, $atIndex+1);
					$local = substr($email, 0, $atIndex);
					$localLen = strlen($local);
					$domainLen = strlen($domain);
					if($localLen < 1 || $localLen > 64) {
						// local part length exceeded
						$isValid = false;
					} else if($domainLen < 1 || $domainLen > 255) {
						// domain part length exceeded
						$isValid = false;
					} else if($local[0] == '.' || $local[$localLen-1] == '.') {
						// local part starts or ends with '.'
						$isValid = false;
					} else if(preg_match('/\\.\\./', $local)) {
						// local part has two consecutive dots
						$isValid = false;
					} else if(!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
						// character not valid in domain part
						$isValid = false;
					} else if(preg_match('/\\.\\./', $domain)) {
						// domain part has two consecutive dots
						$isValid = false;
					} else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
						// character not valid in local part unless local part is quoted
						if(!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) {
								$isValid = false;
						}
					}
					if($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
						// domain not found in DNS
						$isValid = false;
					}
			}
			return $isValid;
		}
		
		public function isPositiveInteger($id) {
			if(is_numeric($id)) {
				if(is_int($id)) {
					if($id > 0) {
						return true;
					}
				}
			}
			return false;
		}
	}
?>