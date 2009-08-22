<?php
class Database {
    private static $instance;
    private $dbh;

    private function __construct() {
	$type = '@DB_TYPE@';
	$host = '@DB_HOST@';
	$name = '@DB_NAME@';
	$user = '@DB_USER@';
	$pass = '@DB_PASS@';

	try {
	    $this->dbh = new PDO("$type:host=$host;dbname=$name", $user, 
		$pass);
	    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, 
		PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
	    $ldoc = LittleDropsOfCode::instance();
	    $ldoc->setErrorPage('db');
	}
    }

    public static function instance() {
	if (!isset(self::$instance)) {
	    $class = __CLASS__;
	    self::$instance = new $class;
	}

	return self::$instance;
    }

    public function connection() {
	return $this->dbh;
    }
}
?>
