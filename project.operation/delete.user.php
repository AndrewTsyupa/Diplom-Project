
<?php
require_once __DIR__ . '/lib/DB.php';
require_once __DIR__ . '/model/User.php';

$uid = $_GET['uid'];//=tid
$deleteUser = User::deleteUser($uid);

if($uid){

    header("Location: /project.task.php?pid=" . $pid);
    die();
}


