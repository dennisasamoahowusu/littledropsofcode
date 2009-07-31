<?php
$user = User::instance();
$v = $user->validate($_POST);

if ($v['valid']) {
    $u = User::instance()->add($_POST);
    $log = array('type' => 'Registration', 'user' => $u['user_id'],
	'summary' => 'User ' . $u['username'] . ' registered');

    ActivityLog::instance()->log($log);
    LittleDropsOfCode::instance()->setPage('post-register');
} else {
    LittleDropsOfCode::instance()->setPage('register');
}
?>
