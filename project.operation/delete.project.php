<?php
require_once __DIR__ . '/lib/DB.php';
require_once __DIR__ . '/model/Project.php';

$pid = $_GET['pid'];
$deleteProject = Project::deleteProject($pid);
echo $pid;

if($pid){
    header("Location: /project.task.php?pid=" . $pid);
    die();
}
/*if (isset($_POST['submit'])) {
    include "project.php";
}*/