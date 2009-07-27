<?php
define(LIBLDOC_PATH, '@LIBLDOC_PATH@');

function __autoload($class) {
    require_once(LIBLDOC_PATH . "/classes/$class.php");
}

// This needs to be here to ensure that the Session constructor runs before 
// the headers are sent.
Session::instance();
$ldoc = LittleDropsOfCode::instance();

if (isset($_GET['action'])) {
    $ldoc->action($_GET['action']);
}

Session::instance()->setNavbarItem($ldoc->getPage());
?>

<html xmlns="http://www.w3.org/1999/xhtml" version="XHTML 1.1">
  <head>
    <title>Little drops of code</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="js/@PKG_JQUERY@" type="text/javascript"></script>
    <script src="js/@PKG_JQUERY_JSON@" type="text/javascript"></script>
  </head>

  <body>
    <div id="page">
      <div id="page-header">
	Little drops of code
      </div>

      <div id="navbar">
	<?php $ldoc->snippet("navbar"); ?>
      </div>

      <?php $ldoc->page($ldoc->getPage()); ?>

      <div id="page-footer">
	Copyright &copy; 2009 Lorenzo Cabrini
      </div>
    </div>
  </body>
</html>
