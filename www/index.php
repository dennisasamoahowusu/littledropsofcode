<?php
define(LIBLDOC_PATH, '@LIBLDOC_PATH@');

function __autoload($class) {
    require_once(LIBLDOC_PATH . "/classes/$class.php");
}

function action($action) {
    require(LIBLDOC_PATH . "/actions/$action.php");
}

function page($page) {
    require(LIBLDOC_PATH . "/pages/$page.php");
}

function snippet($snippet) { 
    require(LIBLDOC_PATH . "/snippets/$snippet.php");
}

// This needs to be here to ensure that the Session constructor runs before 
// the headers are sent.
Session::instance();

if (isset($_GET['action'])) {
    action($_GET['action']);
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}
Session::instance()->setNavbarItem($page);
?>

<html xmlns="http://www.w3.org/1999/xhtml" version="XHTML 1.1">
  <head>
    <title>Little drops of code</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>

  <body>
    <div id="page">
      <div id="page-header">
	Litte drops of code
      </div>

      <div id="navbar">
	<?php snippet("navbar"); ?>
      </div>

      <?php page($page); ?>

      <div id="page-footer">
	Copyright &copy; 2009 Lorenzo Cabrini
      </div>
    </div>
  </body>
</html>
