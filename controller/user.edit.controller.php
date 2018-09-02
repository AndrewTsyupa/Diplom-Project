<?php


$error = '';

if (count($_POST)> 0) {

    $user = User::findByIdInObject($uid);

    $user->first_name = $_POST['first_name'];
    $user->email = $_POST['email'];
    $user->last_name = $_POST['last_name'];
    $user->password = $_POST['password'];


    $error = $user->validate();

    if (count($error) == 0){

        $user->editUser($uid);

        $u = User::findById($uid);

        $_SESSION['user'] = $u;

        header("Location: /project.task.php?pid=" . $user->id);
        die();

    }else {
        $error = "Не всі поля заповнені.";
    }
}