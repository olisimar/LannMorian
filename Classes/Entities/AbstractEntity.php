<?php
	namespace Classes\Entities;
	use System\Exceptions as Exp;
	use Classes\Interfaces as Interfaces;
	
	/**
	 * Abstract class for entities.
	 */
	class AbstractEntity implements Interfaces\Entity {
	
		protected $updated = false;
	
		public function persist() {
			throw new Exp\NotImplementedException();
		}
		
		public function getPrimaryKey() {
			throw new Exp\NotImplementedException();
		}
		
		public function getTableName() {
			throw new Exp\NotImplementedException();
		}
		
		public function remove() {
			throw new Exp\NotImplementedException();
		}
		
		public static function getEntity($id) {
			
		}
		
		public function isUpdated() {
			return $this->updated;
		}
		
		protected function setUpdated($state=true) {
			if(!is_bool($state)) {
				throw new Exp\ValidationException("Entity state was attempted to update to a bad state", 4000);
			}
			$this->updated = $state;
		}
	}
?>