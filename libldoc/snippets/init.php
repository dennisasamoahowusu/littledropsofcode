<?php
function __autoload($class) {
    require_once(LIBLDOC_PATH . "/classes/$class.php");
}

Database::instance();

$ldoc = LittleDropsOfCode::instance();
$ldoc->action();
?>
