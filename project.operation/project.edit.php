<?php
require __DIR__ . '/lib/Session.php';
Session::start();

if (!Session::inSystem()) {
    header("Location: /login.php");
    die();
}
require_once __DIR__ . '/lib/DB.php';
require __DIR__ . '/model/Project.php';
require_once __DIR__ . '/controller/project.user.controller.php';
require_once __DIR__ . '/controller/project.edit.controller.php';

$pid = $_GET['pid'];
?>



<?php require_once __DIR__ . '/layouts/header.php'; ?>
<div class="container-fluid" align="center">

    <div class="col-sm-10" style="width: 800px;margin-top: 50px;">
        <div class="jumbotron">
            <div class="form-group" style="margin-top: -50px;">
               <div align="center">
                <h1 style="">Редагування проекту</h1>
               </div>

            </div>
            <hr>

            <form class="form-horizontal" style="margin-left: 50px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?pid=<?php echo $pid?>" method="POST">

                <div class="form-group">
                    <label for="exampleInputEmail1">Назва проекту</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="text" placeholder="" value="<?= $project['name'] ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Дата початку</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="date_start" placeholder="" value="<?= $project['date_start'] ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Дата кінця</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="date_stop" placeholder="" value="<?= $project['date_stop'] ?>">
                </div>

                <div align="center">
                <button type="submit" name="submit" class="btn btn-primary" style="width: 150px">Зберегти</button>
                </div>
            </form>

        </div>
        <?php require_once __DIR__ . '/layouts/footer.php'; ?>

