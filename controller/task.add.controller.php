<?php

require __DIR__ . '/../model/Task.php';

$error = '';

if (isset($_POST['opis'])) {

    $task = new Task();
    $task->load();

    $error = $task->validate();

    if (count($error) == 0) {
        $task = $task->addTask();

        if ($task) {
            App::redirect("project.tasks.php?pid=" . $_GET['pid']);
        }
    } else {
        $error = "Не всі поля заповнені.";
    }
}


