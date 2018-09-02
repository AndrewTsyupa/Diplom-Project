<?php
require __DIR__ . '/__main.libs.php';
require __DIR__ . '/model/Comment.php';
require __DIR__ . '/model/Task.php';
require __DIR__ . '/model/Project.php';


$task = Task::findById($_POST['task_id']);

if (!$task) {
    die();
}

$canAddComment = Project::userCanView(Session::userId(), $task['project_id']);

if (!$canAddComment){
    die();
}

$comment = new Comment($_POST['task_id'], Session::userId(), $_POST['comment']);

$lastId = $comment->add();

if ($lastId) {
    $time = (new \DateTime())->format('d-m-Y H:i');
    $username = Session::username();
    $text = $comment->comment;

    require __DIR__ . '/_comment.php';
}