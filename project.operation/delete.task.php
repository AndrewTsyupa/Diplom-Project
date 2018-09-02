
<?php
require_once __DIR__ . '/lib/DB.php';
require_once __DIR__ . '/model/Task.php';

$tid = $_GET['tid'];//=tid
$delete = Task::deleteTask($tid);

if($tid){

    header("Location: /project.task.php?pid=" . $pid);
    die();
}




