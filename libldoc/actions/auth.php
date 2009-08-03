<?php
$auth = new Authenticator();
$res = $auth->authenticate($_POST);

if ($res['auth']) {
    Session::instance()->login($_POST['username']);
    LittleDropsOfCode::instance()->setPage('home');
} else {
    LittleDropsOfCode::instance()->setPage('login');
}
?>
