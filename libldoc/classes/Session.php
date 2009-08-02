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

    public function setNavbarItem($item) {
	$_SESSION['navbar_item'] = ucwords($item);
    }

    public function user() {
	return $_SESSION['user'];
    }

    public function setUser($user) {
	$_SESSION['user'] = $user;
    }
}
?>
