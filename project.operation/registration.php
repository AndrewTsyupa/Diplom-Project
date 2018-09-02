<?php
ob_start();
session_start();

require_once __DIR__ . '/controller/registration.controller.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<body>

<div class="container">

      <div class="col-sm-10" style="width: 600px; margin-left: 250px; margin-top: 50px;">
        <div class="jumbotron">
            <div class="form-group" style="margin-top: -50px;">
                <h1 style="margin-left: 165px;">
                    Реєстрація
                </h1>
            </div>
            <hr>


            <form class="form-horizontal" style="margin-left: 50px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

                <div class="form-group input-group">
                         <span class="input-group-addon">
                             <span class="glyphicon glyphicon-home"></span>
                         </span>
                    <input type="text" class="form-control" name="first_name" placeholder="Введіть Ім'я" required>
                </div>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                    <input type="text" class="form-control" name="last_name" placeholder="Введіть прізвище" required>
                </div>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                    <input type="text" class="form-control" name="email" placeholder="Введіть email" required>
                </div>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                    <select class="form-control" name="role_id">
                        <option id="1" value="1">Власник аккаутна</option>
                        <option id="2" value="2">Виконувач</option>
                    </select>
                </div>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                    <input type="password" class="form-control" name="password" placeholder="Введіть пароль" required>
                </div>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                    <input type="password" class="form-control" name="passwordTwo" placeholder="Повторний пароль" required>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary" style="width: 100%;" type="submit" name="submit">Вхід</button>
                </div>

                <div class="form-group">
                    <a href="#" style="margin-left: 310px;"> Забули пароль?</a>
                </div>



            </form>

            Click here to clean <a href="logout.php" tite="Logout">Session.

        </div>
    </div>
</div>

<script src="js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>