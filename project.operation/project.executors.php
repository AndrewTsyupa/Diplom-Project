<?php


require_once __DIR__ . '/lib/DB.php';
require_once __DIR__ . '/model/Project.php';
require_once __DIR__ . '/model/User.php';
//require_once __DIR__ . '/controller/project.user.controller.php';

$pid = $_GET["pid"];
$project = Project::findById($pid);


?>

<?php require_once __DIR__ . '/layouts/header.php'; ?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-7" style="width: 1200px; margin-left: 350px; margin-top: 50px;">
            <div class="jumbotron">
                <div class="form-group" style="margin-top: -50px;">
                    <div align="center">
                    <h1>Виконувачі проекту - <?= $project['name'] ?></h1>
                    </div>
                </div>
                <hr>
            </div>

            <table class="table table-bordered table-hover">

                <thead>
                <tr align="center">
                    <th scope="col">first_name</th>
                    <th scope="col">last_name</th>
                    <th scope="col">email</th>
                    <th scope="col"></th>
                </tr>
                </thead>

            <?php

            $result = DB::queryAll("SELECT * FROM project_team AS p INNER JOIN user WHERE p.project_id = $pid and p.user_id = user.id;");

            if(count($result) > 0){
                foreach ($result as $row){
                 ?>

                    <tr align="center">
                        <td><?= $row['first_name']?></td>
                        <td><?= $row['last_name']?></td>
                        <td><?= $row['email']?></td>
                        <td><a href='delete.user.php?uid=<?= $row['id'] ?>' class='btn btn-primary'>Видалити</a><br></td>
                    </tr>
               <?php
                }
            }?>

            </table>

        </div>

        <?php require_once __DIR__ . '/layouts/footer.php'; ?>



