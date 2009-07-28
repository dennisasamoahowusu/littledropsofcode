<?php
$user = User::instance();
$v = $user->validate($_POST);

if ($v['valid']) {
    User::instance()->add($_POST);
    LittleDropsOfCode::instance()->setPage('home');
} else {
    LittleDropsOfCode::instance()->setPage('register');
}
?>
