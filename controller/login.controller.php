<?php


require __DIR__ . '/../lib/DB.php';
require __DIR__ . '/../model/LoginForm.php';

$error = '';


if (isset($_POST['submit'])) {

    $login = new LoginForm(); //логін екземпляр класу
    $login->load();
    $row = $login->checkLogin();

    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Пароль або Еmail є невірний";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];




        if ($row) {

            $_SESSION['timeout'] = 0;
            $_SESSION['user'] = $row;
            $_SESSION['role_id'] = 1;

            header("Location: dash.php");
        } else {
            $error = "User not found.";
        }

    }
}
