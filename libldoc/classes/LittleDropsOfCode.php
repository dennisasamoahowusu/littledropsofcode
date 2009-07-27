<?php
class LittleDropsOfCode {
    private static $instance;
    private $page;
    private $session;

    private function __construct() {
	$this->session = Session::instance();

	if (isset($_GET['page'])) {
	    $this->setPage($_GET['page']);
	} else {
	    $this->setPage('home');
	}
    }

    public static function instance() {
	if (!isset(self::$instance)) {
	    $class = __CLASS__;
	    self::$instance = new $class();
	}

	return self::$instance;
    }

    public function getPage() {
	return $this->page;
    }

    public function setPage($page) {
	$this->page = $page;
	$this->session->setNavbarItem($page);
    }

    public function action() {
	if (isset($_GET['action'])) {
	    $action = $_GET['action'];
	    require(LIBLDOC_PATH . "/actions/$action.php");
	}
    }

    public function page($page) {
	require(LIBLDOC_PATH . "/pages/$page.php");
    }

    public function snippet($snippet) {
	require(LIBLDOC_PATH . "/snippets/$snippet.php");
    }

    public function jslink() {
	$js = 'js/' . $this->page . '.js';
	if (file_exists($js)) {
	    return '<script src="' . $js . '" type="text/javascript">'
		. '</script>';
	} else {
	    return '';
	}
    }

}
