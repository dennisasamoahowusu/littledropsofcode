<?php
class Session {
    private static $instance;

    private function __construct() {
	session_start();
    }

    public function instance() {
	if (!isset(self::$instance)) {
	    $class = __CLASS__;
	    self::$instance = new $class;
	}

	return self::$instance;
    }

    public function navbarItem() {
	if (isset($_SESSION['navbar_item'])) {
	    return $_SESSION['navbar_item'];
	} else {
	    return 'Home';
	}
    }
}
?>
