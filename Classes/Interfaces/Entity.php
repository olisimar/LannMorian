<?php
	namespace Classes\Interfaces;
	/**
	 * Base interface for a DB entity used by the application.
	 *
	 */
	interface Entity {
		public function persist();
		public function getPrimaryKey();
		public function remove();
	}
?>