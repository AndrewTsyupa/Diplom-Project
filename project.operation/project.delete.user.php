
<?php
require __DIR__ . '/__main.libs.php';
require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/model/Project.php';

$uid = $_GET['uid'];
$pid = $_GET['pid'];

$isOwner = Project::userIsOwnerOfProject($uId, $pId);

if ($isOwner) {
    Project::deleteUserFromProject($pid, $uid);
}
App::redirect("project.tasks.php?pid=" . $pid);