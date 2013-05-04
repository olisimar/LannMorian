<?php
	namespace Classes\Interfaces;
	/**
	 * Base interface for a DB entity used by the application.
	 *
	 */
	interface Entity {
		public function persist();
		public function remove();
		
		public function getPrimaryKey();
		public function getTableName();
		public function isUpdated();
		
		/**
		This function is meant to be used to retrieve any kind of Entity
		of that class from the DB based on a singular ID. If the entity
		needs a compound key this function will only return false.
		*/
		public static function getEntity($id);
	}
?>