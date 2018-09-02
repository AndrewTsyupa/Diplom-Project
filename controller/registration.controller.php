<?php

require __DIR__ . '/../lib/DB.php';
require __DIR__ . '/../model/User.php';



$error = '';
if (isset($_POST['submit'])) {

    $user = new User();
    $user->load();

    // empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passworTwo'])

    $errors = $user->validate();

    if (count($errors) == 0) {
        $password = trim($_POST['passwordTwo']);

        if ($user->password === $_POST['passwordTwo']){

            $user = $user->addUser();

            if ($user){

                // login
                $_SESSION['timeout'] = time();
                $_SESSION['user'] = $user;
                $_SESSION['role_id'] = 1 && 2 ;


                header("Location: /dash.php");
                die();
            }

        } else {
            $error = 'Неправлтидльний Повторення паролю.';
        }
    } else {
        $error = "Не всі поля заповнені.";



    }
}
