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
require_once __DIR__ . '/controller/task.edit.controller.php';



$pid = $_GET['pid'];
$project = Project::findById($pid);




?>


<?php require_once __DIR__ . '/layouts/header.php' ?>


<div class="table">

    <div class="row">

        <div class="col-md-9" style="width: 1200px; margin-left: 350px; margin-top: 50px;">

            <div class="jumbotron">
                <div class="form-group" style="margin-top: -50px;">
                    <div align="center">
                    <h1 >Дадати завдання до проекту - <?= $project['name'] ?></h1>
                    </div>
                </div>
                <hr>
                <div align="center">
                <a class="btn btn-outline-success my-2 my-sm-0" href="add.task.php?pid=<?= $pid ?>">Додати завдання</a>
                </div>
            </div>



            <table class="table table-bordered table-hover">

                <thead>
                <tr align="center">

                    <th scope="col">Номер</th>
                    <th scope="col">Email</th>
                    <th scope="col">Назва завдання</th>
                    <th scope="col" width="300px;">Опис</th>
                    <th scope="col">Час початку</th>
                    <th scope="col">Час закінчення</th>




                </tr>
                </thead>


                <?php


                $result = DB::queryAll("SELECT t.*, user.email FROM task AS t  
              INNER JOIN user WHERE project_id = $pid AND t.user_id = user.id;");

                if (count($result) > 0) {
                    foreach ($result as $row) {

                        ?>
                        <tr align="center">
                            <td><?= $row['id'] ?><br></td>
                            <td><?= $row['email'] ?><br></td>
                            <td><?= $row['name'] ?><br></td>
                            <td><?= $row['opis'] ?><br></td>
                            <td><?= $row['date_start'] ?><br></td>
                            <td><?= $row['date_end'] ?><br></td>
                            <td><a href='revision.task.php?tid=<?= $row['id'] ?>' class='btn btn-primary'>Переглянути завдання</a><br></td>
                            <td><a href='task.edit.php?tid=<?= $row['id'] ?>' class='btn btn-primary'>Редагування</a><br></td>
                            <td><a href='delete.task.php?tid=<?= $row['id'] ?>' class='btn btn-primary'>Видалення</a><br></td>


                        </tr>
                    <?php }

                }

                ?>


            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php' ?>




