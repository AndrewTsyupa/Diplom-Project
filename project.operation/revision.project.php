<?php
require_once __DIR__ . '/../diplom/lib/DB.php';
require __DIR__ . '/model/Project.php';
require __DIR__ . '/model/Task.php';
require __DIR__ . '/model/User.php';
require_once __DIR__ . '/controller/user.edit.controller.php';
require_once __DIR__ . '/controller/task.edit.controller.php';


$pid = $_GET['pid'];
$project = Project::findById($pid);

$sql = "SELECT * FROM project WHERE project.id = $pid";

$result = DB::queryAll($sql);
if (count($result) > 0){
foreach ($result

as $row) {

?>
<?php require_once __DIR__ . '/layouts/header.php' ?>

<div class="container-fluid">

    <div class="row">
        <div align="center">
            <div class="col-md-8" style="width: 1200px; margin-left: 300px; margin-top: 50px;">
                <div class="jumbotron">
                    <div class="form-group" style="margin-top: -50px; align-content: center;">
                        <div align="center">
                            <h1 style=" align-content: center;">Проект - <?= $pid ?> </h1>
                        </div>
                    </div>
                    <hr>
                </div>

                <form class="form-horizontal" style="margin-left: 50px;"
                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">


                    <table class="table">

                        <thead>
                        <tr>
                            <td><label for="inputPassword6">Назва проекту</label></td>
                            <td><label for="exampleInputPassword1"><?= $row["name"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Дата початку </label></td>
                            <td><label for="exampleInputPassword1"><?= $row["date_start"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Дата закінчення </label></td>
                            <td><label for="exampleInputPassword1"><?= $row["date_stop"]; ?></label></td>
                        </tr>

                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php
    }
    }
    ?>

    <div class="row">
        <div align="center">
            <div class="col-md-8" style="width: 1200px; margin-left: 300px; margin-top: 50px;">
                <?php

                $uid = $_GET['uid'];
                $user = User::findById($uid);

                $sql = "SELECT * FROM user WHERE user.id=$uid;";

                $result = DB::queryAll($sql);
                if (count($result) > 0) {
                foreach ($result

                as $rows) {
                ?>
                <form class="form-horizontal" style="margin-left: 50px;"
                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                    <div class="jumbotron">
                        <div class="form-group" style="margin-top: -50px; align-content: center;">
                            <div align="center">
                                <h1 style=" align-content: center;">Керівник пронету</h1>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <table class="table">

                        <thead>
                        <tr>
                            <td><label style="width: 168px;" for="inputPassword6">Ім'я </label></td>
                            <td><label for="exampleInputPassword1"><?= $rows["first_name"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Прізвище </label></td>
                            <td><label for="exampleInputPassword1"><?= $rows["last_name"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Email</label></td>
                            <td><label for="exampleInputPassword1"><?= $rows["email"]; ?></label></td>
                        </tr>

                        </thead>
                    </table>

                </form>
            </div>
        </div>
    </div>

    <?php
    }
    }
    ?>


    <div class="row">
        <div align="center">
            <div class="col-md-8" style="width: 1200px; margin-left: 300px; margin-top: 50px;">
                <?php

                $tid = $_GET['tid'];
                $task = Task::findById($tid);

                $sql = "SELECT * FROM task WHERE task.id=$tid";
                $result = DB::queryAll($sql);


                if (count($result) > 0) {
                foreach ($result
                as $rows) {
                ?>
                <form class="form-horizontal" style="margin-left: 50px;"
                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                    <div class="jumbotron">
                        <div class="form-group" style="margin-top: -50px; align-content: center;">
                            <div align="center">
                                <h1 style=" align-content: center;">Перелік завдань проекту </h1>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <table class="table">

                        <thead>
                        <tr>
                            <td><label style="width: 168px;" for="inputPassword6">Назва завдання</label></td>
                            <td><label for="exampleInputPassword1"><?= $rows["name"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Опис </label></td>
                            <td><label for="exampleInputPassword1"><?= $rows["opis"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Дата початку</label></td>
                            <td><label for="exampleInputPassword1"><?= $rows["date_start"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Дата закінчення</label></td>
                            <td><label for="exampleInputPassword1"><?= $rows["date_end"]; ?></label></td>
                        </tr>

                        </thead>
                    </table>

                </form>
            </div>
        </div>
    </div>

    <?php
    }
    }
    ?>

    <div class="row">
        <div align="center">
            <div class="col-md-8" style="width: 1200px; margin-left: 300px; margin-top: 50px;">
                <?php


                $result = DB::queryAll("SELECT * FROM project_team AS p INNER JOIN user WHERE p.project_id = $pid and p.user_id = user.id;");
                if(count($result) > 0){
                foreach ($result as $row){

                ?>
                <form class="form-horizontal" style="margin-left: 50px;"
                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                    <div class="jumbotron">
                        <div class="form-group" style="margin-top: -50px; align-content: center;">
                            <div align="center">
                                <h1 style=" align-content: center;">Перелік завдань проекту </h1>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <table class="table">

                        <thead>
                        <tr>
                            <td><label style="width: 168px;" for="inputPassword6">Назва завдання</label></td>
                            <td><label for="exampleInputPassword1"><?= $row["first_name"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Опис </label></td>
                            <td><label for="exampleInputPassword1"><?= $row["last_name"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Дата початку</label></td>
                            <td><label for="exampleInputPassword1"><?= $row["email"]; ?></label></td>
                        </tr>



                        </thead>
                    </table>

                </form>
            </div>
        </div>
    </div>

<?php
}
}
?>




    <?php require_once __DIR__ . '/layouts/footer.php' ?>
