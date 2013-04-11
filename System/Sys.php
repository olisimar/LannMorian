<?php
	namespace System;
	use System\Exceptions as Exp;

	class Sys {

		private static $me = null;
	
		private function __construct() {
			session_start();
		}

		public static function getInstance() {
			if(!isset(Sys::$me)) {
				$me = new Sys();
			}
			return $me;
		}

		public function getDB() {
			return DB::getInstance();
		}
	}
?>