<?php
require __DIR__ . '/__main.libs.php';
require_once __DIR__ . '/model/Project.php';
require_once __DIR__ . '/model/Task.php';

$tid = $_GET['tid'];

$task = Task::findById($tid);

if ($task) {
    $is = Project::userIsOwnerOfProject(Session::userId(), $task['project_id']);

    if (!$is) {
        App::dash();
    }

    $delete = Task::closeTask($tid, $_GET['status']);

    if ($tid) {
        App::redirect("project.tasks.php?pid=" . $task['project_id']);
    }
} else {
    App::dash();
}