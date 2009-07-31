<?php
$user = User::instance();
$v = $user->validate($_POST);

if ($v['valid']) {
    $u = User::instance()->add($_POST);
    ActivityLog::instance()->registration($u);
    LittleDropsOfCode::instance()->setPage('post-register');
} else {
    LittleDropsOfCode::instance()->setPage('register');
}
?>
