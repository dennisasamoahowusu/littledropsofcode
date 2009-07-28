<?php
if (get_magic_quotes_gpc()) {
    $data = json_decode(stripslashes($_POST['data']), true);
} else {
    $data = json_decode($_POST['data'], true);
}

foreach ($data as $item) {
    $user[$item['name']] = $item['value'];
}

$resp = User::instance()->validate($user);
echo json_encode($resp);
?>
