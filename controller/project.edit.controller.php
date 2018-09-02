<?php



$error = '';

if (count($_POST)> 0) {

    $project = Project::findByIdInObject($pid);

    $project->name = $_POST['name'];
    $project->date_start = $_POST['date_start'];
    $project->date_stop = $_POST['date_stop'];



    $error = $project->validate();

    if (count($error) == 0){

        $project->editProject($pid);

        header("Location: /project.task.php?pid=" . $task->project_id);
        die();

    }else {
        $error = "Не всі поля заповнені.";
    }
}