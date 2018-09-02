<?php



$error = '';

if (count($_POST)> 0) {

    $task = Task::findByIdInObject($tid);

    $task->user_id = $_POST['user_id'];
    $task->name = $_POST['name'];
    $task->opis = $_POST['opis'];
    $task->date_start = $_POST['date_start'];
    $task->date_end = $_POST['date_end'];

    $error = $task->validate();

    if (count($error) == 0){

        $task->editTask($tid);

        header("Location: /project.task.php?pid=" . $task->project_id);
        die();

    }else {
        $error = "Не всі поля заповнені.";
    }
}