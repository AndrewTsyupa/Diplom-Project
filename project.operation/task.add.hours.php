<?php

require __DIR__ . '/__main.libs.php';
require __DIR__ . '/model/Comment.php';
require __DIR__ . '/model/Task.php';
require __DIR__ . '/model/Project.php';


if (isset($_GET['id']) && isset($_POST['hodini']) && is_numeric($_POST['hodini'])) {
    $task = Task::findById($_GET['id']);

    if (!$task) {
        App::dash();
    }

    $canAddComment = Project::userCanView(Session::userId(), $task['project_id']);

    if (!$canAddComment) {
        App::dash();
    }

    $hodini = $_POST['hodini'];
    $date = $_POST['date'];

    if ($hodini && $date){
        Task::addHodini($task['id'], $hodini, $date);
    }



    App::redirect('task.view.php?tid=' . $task['id']);
}