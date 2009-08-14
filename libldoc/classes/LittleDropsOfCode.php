<?php
class LittleDropsOfCode {
    private static $instance;
    private $errorPage;
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

    public function errorPage() {
	return $this->errorPage;
    }

    public function setErrorPage($errorPage) {
	$this->errorPage = $errorPage;
    }

    public function action() {
	if (isset($_GET['action'])) {
	    $action = $_GET['action'];
	    require(LIBLDOC_PATH . "/actions/$action.php");
	}
    }

    public function page($page) {
	if (isset($this->errorPage)) {
	    require(LIBLDOC_PATH . "/error/" . $this->errorPage);
	} elseif (file_exists(LIBLDOC_PATH . "/pages/$page.php")) {
	    require(LIBLDOC_PATH . "/pages/$page.php");
	} else {
	    require(LIBLDOC_PATH . "/error/nopage.php");
	}
    }

    public function snippet($snippet) {
	require(LIBLDOC_PATH . "/snippets/$snippet.php");
    }

    public function ajax($ajax) {
	require(LIBLDOC_PATH . "/ajax/$ajax.php");
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
