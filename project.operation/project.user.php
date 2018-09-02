<?php


require_once __DIR__ . '/lib/DB.php';
require_once __DIR__ . '/model/Project.php';
require_once __DIR__ . '/model/User.php';
//require_once __DIR__ . '/controller/project.user.controller.php';
//require_once __DIR__ . '/project.add.user.php';

$pid = $_GET["pid"];
$project = Project::findById($pid);


?>
<?php require_once __DIR__ . '/layouts/header.php'; ?>


<div class="container-fluid">

    <div class="row">

        <div class="col-md-7" style="width: 600px; margin-left: 350px; margin-top: 50px;">

            <div class="jumbotron">
                <div class="form-group" style="margin-top: -50px;">
                    <div align="center">
                    <h1>Запросити в проект <?= $project['name'] ?></h1>
                    </div>
                </div>
                <hr>
            </div>


            <table class="table table-bordered table-hover">

                <thead>
                <tr align="center">
                    <th scope="col">Номер</th>
                    <th scope="col">Ім'я</th>
                    <th scope="col">Прізвище</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
                </thead>

                <?php

                $result = DB::queryAll("SELECT * FROM user;");

                if(count($result) > 0){
                    foreach ($result as $row){
                        ?>

                        <tr align="center">
                            <td><?= $row['id']?></td>
                            <td><?= $row['first_name']?></td>
                            <td><?= $row['last_name']?></td>
                            <td><?= $row['email']?></td>
                            <td>
                                <a href='project.add.user.php?uid=<?= $row['id'] ?>&pid=<?= $project['id'] ?>' class='btn btn-primary'">Додати</a>
                            </td>
                        </tr>
                        <?php
                    }
                }?>

            </table>
        </div>

    </div>

</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>