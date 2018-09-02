<?php
require __DIR__ . '/lib/Session.php';
Session::start();

if (!Session::inSystem()) {
    header("Location: /login.php");
    die();
}

require_once __DIR__ . '/controller/project.controller.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>Document</title>
</head>
<body>

<?php require_once __DIR__ . '/layouts/header.php'; ?>
<div class="container-fluid">


    <div class="row" align="center">
        <div class="col-md-7" style="width: 1200px; margin-left: 300px; margin-top: 50px;">

            <div class="col-sm-10" style="width: 1200px; margin-left: 130px; margin-top: 50px;">
                <div class="jumbotron">
                    <div class="form-group" style="margin-top: -50px;">
                        <div align="center">
                        <h1>
                            Новий Проект
                        </h1>
                    </div>
                    </div>
                    <hr>

            <form class="form-horizontal" style="margin-left: 50px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

                <div class="form-group input-group">
                         <span class="input-group-addon">
                             <span class="glyphicon glyphicon-home"></span>
                         </span>
                    <input type="text" class="form-control" name="name" placeholder="Назва завдання" required>
                </div>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                    <input type="text" class="form-control" name="date_start" placeholder="Дата початку" required>
                </div>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                    <input type="text" class="form-control" name="date_stop" placeholder="Дата закінчення" required>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary" style="width: 100%;" type="submit" name="submit">Створити</button>
                </div>

            </form>
        </div>
        </div>
</div>
<?php require_once __DIR__ . '/layouts/footer.php'; ?>

