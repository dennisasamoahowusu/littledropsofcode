<?php
$page = LittleDropsOfCode::instance()->getPage();
$tracker = "http://github.com/lcabrini/littledropsofcode/issues";
?>

<h2>404</h2>

<p>You are looking for the page <span class="missing"><?= $page ?></span>, 
which does not exist.</p> 

<p>If you got here by clicking a link on the site, there is probably a bug 
hiding somewhere in the code. Please report it to our issue tracking system at 
<a href="<?= $tracker ?>"><?= $tracker ?></a>.</p>
