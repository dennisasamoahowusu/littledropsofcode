<?php
define(LIBLDOC_PATH, '@LIBLDOC_PATH@');
require_once(LIBLDOC_PATH . "/snippets/init.php");
?>

<html xmlns="http://www.w3.org/1999/xhtml" version="XHTML 1.1">
  <head>
    <title>Little drops of code</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="js/@PKG_JQUERY@" type="text/javascript"></script>
    <script src="js/@PKG_JQUERY_JSON@" type="text/javascript"></script>
    <script src="js/init.js" type="text/javascript"></script>
    <?= $ldoc->jslink() ?>
  </head>

  <body>
    <?php $ldoc->snippet("topbar"); ?>

    <div id="page">
      <div id="page-header">
	Little drops of code
      </div>

      <div id="navbar">
	<?php $ldoc->snippet("navbar"); ?>
      </div>

      <div id="messages">
	<?php $ldoc->snippet("messages"); ?>
      </div>

      <?php $ldoc->page($ldoc->getPage()); ?>

      <div id="page-footer">
	Copyright &copy; 2009 Lorenzo Cabrini
      </div>
    </div>
  </body>
</html>
