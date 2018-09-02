<?php

require __DIR__ . '/../lib/DB.php';
require __DIR__ . '/../model/Project.php';

$error = '';

if (isset($_POST['name'])) {

    $project = new Project();
    $project->load();

    $error = $project->validate();

    if (count($error) == 0){
        $name = trim($_POST['name']);

        if ($project->name === $_POST['name']){

            $project = $project->addProject();

            if($project){

                $_SESSION['timeout'] = time();
                $_SESSION['project'] = $project;
                $_SESSION['role_id'] = 1;

                header("Location: /dash.php");
                die();
            }

        }else {
            $error = 'Неправлтидльний Повторення паролю.';
        }
        }else {
        $error = "Не всі поля заповнені.";
    }
}