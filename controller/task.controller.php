<?php

require __DIR__ . '/../lib/DB.php';
require __DIR__ . '/../model/Task.php';

$error = '';

if (isset($_POST['opis'])) {

    $task = new Task();
    $task->load();

    $error = $task->validate();

    if (count($error) == 0){
        $opis = trim($_POST['opis']);

        if ($task->opis === $_POST['opis']){

            $task = $task->addTask();

            if($task){

                $_SESSION['timeout'] = time();
                $_SESSION['task'] = $task;
                $_SESSION['role_id'] = 1;

                header("Location: /project.task.php?pid=" . $pid);
                die();
            }

        }else {
            $error = 'Неправлтидльний Повторення паролю.';
        }
    }else {
        $error = "Не всі поля заповнені.";
    }
}


