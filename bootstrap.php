<?php
/**
 * This is a bootstrap file to include the various base things such as the
 * autoloader and error to exception handling.
 */
	define("BASE_DIR", "/srv/www/htdocs/good-omens/");
 	require_once BASE_DIR. '/System/sys_config.php';

	class ClassAutoloader {
    public function __construct() {
			spl_autoload_register(array($this, 'loader'));
		}

    private function loader($className) {
			$toLoad = str_replace("\\", DIRECTORY_SEPARATOR, $className);
      include $toLoad. '.php';
		}
  }

	function exceptions_error_handler( $severity, $message, $filename, $lineno ) {
		if( error_reporting() == 0 ) {
			return;
		}
		if( error_reporting() & $severity ) {
			throw new ErrorException( $message, 0, $severity, $filename, $lineno );
		}
	}

	set_error_handler( 'exceptions_error_handler' );
	$autoloader = new ClassAutoloader();
?>