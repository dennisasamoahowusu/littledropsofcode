<ul id="navlist">
<?php
$items = array('Home', 'Login', 'Register');
$current = Session::instance()->navbarItem();

foreach ($items as $item) {
    echo '<li>';
    echo '<a href="index.php?page=' . strtolower($item) . '"';
    if ($current == $item) {
	echo ' id="active-navbar-item"';
    }
    echo '>' . $item . '</a></li>';
}
?>
</ul>
