<?php
	namespace Classes\Entities;
	use Classes\Entities as CE;
	use System\Exceptions as Exp;
	
	/**
	 * Defines an article in the web-application.
	 */
	class Article extends CE\AbstractEntity {
		
		private $articleId = null;
		private $order = 0;
		private $category = null;
		private $title = null;
		private $article = null;
		private $author = null;
		private $ip = null;
		private $email = null;
		
		public function __construct($id=null) {
			if(isset($id)) {
				$this->loadArticleFromDatabase($id);
			}
		}
		
		public function getPrimaryKey() {
			if(isset($this->articleId)) {
				return $this->articleId;
			}
			return null;
		}
		
		public function persist() {
			if(isset($this->articleId)) { // TODO Update
				
			} else { // TODO Insert
				
			}
		}
		
		public function remove() {
			if(isset($this->articleId)) { // TODO Remove
				
			}
		}
		
		public function getArticleId() {
			return $this->articleId;
		}
		public function getOrder() {
			return $this->order;
		}
		public function getCategory() {
			return $this->category;
		}
		public function getTitle() {
			return $this->title;
		}
		public function getArticle() {
			return $this->article;
		}
		public function getAuthor() {
			return $this->author;
		}
		public function getIp() {
			return $this->ip;
		}
		public function getEmail() {
			return $this->email;
		}
		public function getCreated() {
			return $this->created;
		}
		public function getUpdated() {
			return parent::isUpdated();
		}
		
		public function setUpdated($updated=true) { 
			parent::setUpdated($updated);
		}		
		public function setArticleId($artileId) {
			$this->articleId = $artileId;
		}
		public function setOrder($order) {
			$this->order = $order;
		}
		public function setCategory($category) {
			$this->category = $category;
		}
		public function setTitle($title) {
			$this->title = $title;
		}
		public function setArticle($article) {
			$this->article = $article;
		}
		public function setAuthor($author) {
			$this->author = $author;
		}
		public function setIp() {
			$this->ip = $ip;
		}
		public function setEmail($email) {
			if(System\Validator::isEmail($email)) {
				$this->email = $email;
			} else {
				throw new ValidationException("Invalid email tried to be set on Article.", 4000, null, $email);
			}
		}
		public function setCreated($created) {
			$this->$created = $created;
		}
	}
?>