<?php
ob_start();
session_start();

require_once __DIR__ . '/controller/login.controller.php';
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
                <h1 style="margin-left: 215px;">
                    Увійти
                </h1>
            </div>
            <hr>

            <div class="col-sm-12">
                <h4 class="form-signin-heading"><?php echo $error; ?></h4>
            </div>


            <form class="form-horizontal" style="margin-left: 50px;"
                  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <div class="form-group input-group">
                         <span class="input-group-addon">
                             <span class="glyphicon glyphicon-home"></span>
                         </span>
                    <input type="email" class="form-control" name="email" placeholder="Введіть Електронну пошту"
                           required>
                </div>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                    <input type="password" class="form-control" name="password" placeholder="Введть Пароль" required>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox">
                        Запам'ятати мене
                    </label>
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