<?php
	namespace System;
	use System\Exceptions as Exp;
	
	class DB {

		private static $me = null;

		private function __construct() {
			DB::$me = $this;
		}

		public static function getInstance() {
			if( DB::$me == null ) {
				try {
					DB::$me = new \mysqli(
						DB_SERVER,
						DB_USER,
						DB_PASSWD,
						DB_NAME
					);
				} catch( ErrorException $ee ) {
					$message = "ErrorException in LogDB:getInstance >> ";
					// Just make the line numbers match if you alter anything.
					switch( $ee->getLine() ) {
						case 39:	$message .= "Bad Host provided from configuration.php";
						case 40:	$message .= "Bad User provided from configuration.php";
						case 41:	$message .= "Bad Password provided from configuration.php";
						case 42:	$message .= "Bad DB name provided from configuration.php";
					}
					throw new Exception( $message, 0, $ee );
				} catch( Exception $e ) {
					throw new Exception( "General Exception in DB:getInstance failed.", 0, $e );
				}
			}

			return DB::$me;
		}
		
		public static function clean( $inData ) {
			$outData = "";

			if( get_magic_quotes_gpc() == 1 ) {
				$inData = stripslashes( $inData );
			}

			if( is_numeric( $inData ) ) {
				$outData = $inData;
			} else {
				$conn = DB::getInstance();
				$outData = $conn->real_escape_string( $inData );
			}

			return $outData;
		}
		
		public function query($sql) {
			try {
				$result = DB::query($sql);
				return $result;
			} catch(Exception $e) {
				throw new DataBaseException("Failed to execute query.", 2100, $e, $sql);
			}
		}
	}

	/*
	<?php

		class DB {
			static private $DB; // The Singelton



			public static function query( $sql ) {
				try {
					$result = DB::getInstance()->query( $sql );
					return $result;
				} catch ( ErrorException $ee ) {
					throw new DataBaseException( "Failed to connect to database to execute query", 2100, $ee, $sql );
				}
			}

			public static function processQueryResult( $result ) {
				$returnArray = array();
				$counter = 0;
				if( is_object( $result ) ) {
					while( $row = $result->fetch_assoc() ) {
						$returnArray[] = $row;
					}
				}
				return $returnArray;
			}

			public static function insert( $sql, $table, $pk="id" ) {
				try {
					$table = DB::clean( $table );
					$pk = DB::clean( $pk );
					$result = DB::getInstance()->query( $sql );
					if( $result == 1 ) {
						try {
							$id = $result->insert_id;
							if( $id != null && $id != 0 ) {
								return $id;
							} else { // if the above calls failed, this is the fallback.
								$sqlPK = "SELECT `".$pk."` FROM `$table` ORDER BY `$pk` DESC LIMIT 1;";
								$result = DB::getInstance()->query( $sqlPK );
								if( $result->num_rows == 1 ) {
									$result = $result->fetch_assoc();
									return $result[ $pk ];
								} else {
									throw new DataBaseException( "Insert worked but the primary key failed to be retrieved properly. Got ". $result, 2200, null, $sqlPK );
								}
							}
						} catch( ErrorException $ee ) {
							$sqlPK = "SELECT `".$pk."` FROM `$table` ORDER BY `$pk` DESC LIMIT 1;";
							$result = DB::getInstance()->query( $sqlPK );
							if( $result->num_rows == 1 ) {
								$result = $result->fetch_assoc();
								return $result[ $pk ];
							} else {
								throw new DataBaseException( "Insert worked but the primary key failed to be retrieved properly. Got ". $result, 2200, null, $sqlPK );
							}
						}

					} else {
						throw new DataBaseException( "Failed to insert the statement.", 2200, null, $sql );
					}
				} catch( ErrorException $ee ) {
					throw new DataBaseException( "Failed to insert the entity properly.", 2200, $ee, $sql );
				}
			}

			public static function update( $sql ) {
				try {
					if( DB::getInstance()->query( $sql )== 1 ) { return true; } else { return false; }
				} catch( ErrorException $ee ) {
					throw new DataBaseException( "Failed to update entity.", 2300, $ee, $sql );
				}
			}

			public static function delete( $sql ) {
				try {
					if( DB::getInstance()->query( $sql ) == 1 ) { return true; } else { return false; }
				} catch( ErrorException $ee ) {
					throw new DataBaseException( "Failed to delete entity.", 2400, $ee, $sql );
				}
			}

		}
	*/
?>

