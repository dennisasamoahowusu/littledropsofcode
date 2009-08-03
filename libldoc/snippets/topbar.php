<?php
$sess = Session::instance();

if ($sess->isLoggedIn()) { 
    $u = $sess->user(); 
    ?>

    <div id="topbar">
      <?= $u['fullname'] ?>
      <a href="index.php?action=logout">Logout</a>
    </div>
<?php } ?>
