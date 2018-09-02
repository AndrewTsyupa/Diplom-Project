
<?php
require __DIR__ . '/__main.libs.php';
require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/model/Project.php';

$uid = Session::userId();
$pid = $_GET['pid'];
Project::deleteUserFromProject($pid, $uid);
App::redirect("project.view.php?pid=" . $pid);