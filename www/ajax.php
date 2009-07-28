<?php
define(LIBLDOC_PATH, '@LIBLDOC_PATH@');

function __autoload($class) {
    require_once(LIBLDOC_PATH . "/classes/$class.php");
}

$ldoc = LittleDropsOfCode::instance();
$ldoc->ajax($_GET['action']);
?>
