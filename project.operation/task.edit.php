<?php

require __DIR__ . '/lib/Session.php';
Session::start();

if (!Session::inSystem()) {
    header("Location: /login.php");
    die();
}

$tid = $_GET['tid'];

require_once __DIR__ . '/lib/DB.php';
require __DIR__ . '/model/Task.php';
require __DIR__ . '/model/User.php';
//require_once __DIR__ . '/controller/project.user.controller.php';
require_once __DIR__ . '/controller/task.edit.controller.php';
//require_once __DIR__ . '/controller/task.controller.php';


$task = Task::findById($tid);


?>

<?php require_once __DIR__ . '/layouts/header.php'; ?>
<div class="container">

    <div class="col-sm-10" style="width: 1200px; margin-left: 130px; margin-top: 50px;">
        <div class="jumbotron">
            <div class="form-group" style="margin-top: -50px;">
                <h1 style="margin-left: 290px;">
                    Редагування завдання
                </h1>
            </div>
            <hr>


            <form class="form-horizontal" style="margin-left: 50px;"
                  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?tid=<?php echo $tid ?>" method="POST">


                <div class="form-group input-group">
                         <span class="input-group-addon">
                             <span class="glyphicon glyphicon-home"></span>
                         </span>
                    <select class="form-control" name="user_id">
                        <?php
                        $users = User::getUsersByProject($task['project_id']);
                        foreach ($users as $uid => $user) { ?>
                            <option value="<?= $uid ?>" <?php if ($task['user_id'] == $uid) { ?> selected="selected"<?php } ?>><?= $user ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Назва завдання</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name" placeholder=""
                           value="<?= $task['name'] ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Опис</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="opis" placeholder=""
                           value="<?= $task['opis'] ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Час початку</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="date_start" placeholder=""
                           value="<?= $task['date_start'] ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Час закінчення</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="date_end" placeholder=""
                           value="<?= $task['date_end'] ?>">
                </div>

                <button type="submit" name="submit"  class="btn btn-primary">Зберегти</button>
            </form>

        </div>
        <?php require_once __DIR__ . '/layouts/footer.php'; ?>

