<?php
ob_start();
session_start();


$pid = $_GET['pid'];

require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/controller/task.controller.php';


?>

<?php require_once __DIR__ . '/layouts/header.php'; ?>
<div class="container">

    <div class="col-sm-10" style="width: 1200px; margin-left: 130px; margin-top: 50px;">
        <div class="jumbotron">
            <div class="form-group" style="margin-top: -50px;">
                <h1 style="margin-left: 290px;">
                    Нове завдання
                </h1>
            </div>
            <hr>

            <form class="form-horizontal" style="margin-left: 50px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?pid=<?= $pid ?>" method="POST">


                <div class="form-group input-group">
                         <span class="input-group-addon">
                             <span class="glyphicon glyphicon-home"></span>
                         </span>
                    <select class="form-control" name="user_id">
                        <?php
                        $users = User::getUsersByProject($pid);
                        foreach ($users as $uid => $user) { ?>
                            <option value="<?= $uid ?>"><?= $user?></option>
                        <?php } ?>
                    </select>
                </div>

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
                    <input type="text" class="form-control" name="opis" placeholder="Опис завдання" required>
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

                    <input type="text" class="form-control" name="date_end" placeholder="Дата закінчення" required>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary" style="width: 100%;" type="submit" name="submit">Створити</button>
                </div>

            </form>
        </div>
        <?php require_once __DIR__ . '/layouts/footer.php'; ?>

