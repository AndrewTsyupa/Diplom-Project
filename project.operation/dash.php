<?php


require __DIR__ . '/lib/Session.php';
Session::start();

if (!Session::inSystem()) {
    header("Location: /login.php");
    die();
}
?>

<?php
require __DIR__ . '/../diplom/lib/DB.php';


if (isset($_POST['submit'])) {
    include "project.php";
}

?>

<?php require_once __DIR__ . '/layouts/header.php'; ?>

    <div class="container-fluid">
        <div class ="row">
            <div class="col-md-11" style="width: 1400px; margin-left: 170px; margin-top: 50px;">
                <div align="center">
                    <div class="jumbotron">
                        <div class="form-group" style="margin-top: -50px; align-content: center;">
                            <div align="center">
                                <h1 style=" align-content: center;">Проекти</h1>
                            </div>
                    </div>
                    <hr>
                </div>

                <table class="table table-bordered table-hover ">

                    <thead>
                    <tr align="center">
                        <th scope="col">Номер</th>
                        <th scope="col">Назва проекту</th>
                        <th scope="col">Власник</th>
                        <th scope="col">Дата початку</th>
                        <th scope="col">Дата закінчення</th>
                        <th scope="col"></th>

                    </tr>

                    <tr>

                    </tr>

                    </thead>
                    <?php

                    $uid = $_SESSION['user']['id'];


                    $sql = "SELECT p.*, concat(u.first_name, ' ', u.last_name) as username
                                  FROM project p
                                  left join project_team pt on pt.project_id = p.id
                                  INNER JOIN user u on p.owner_id = u.id
                                  WHERE p.owner_id=$uid or pt.user_id = $uid";


                    $result = DB::queryAll($sql);


                    if (count($result) > 0){
                    foreach ($result as $row) {
                        ?>
                        <tr align="center">
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["name"] ?></td>
                            <td><?= $row["username"] ?></td>
                            <td><?= $row["date_start"] ?></td>
                            <td><?= $row["date_stop"] ?></td>
                            <td><?php
                                $sql_Two = "SELECT * FROM task;";
                                $result_Two = DB::queryAll($sql_Two);
                                if (count($result) > 0) {
                                    foreach ($result_Two as $rows) {
                                        ?>
                                    <?php } ?>
                                    <?php
                                } else {
                                    echo "0 result";
                                }
                                ?>
                                <a href='revision.project.php?pid=<?= $row['id'] ?>&uid=<?= $uid ?>&tid=<?= $rows['id'] ?>'
                                   class='btn btn-primary' style="width: 120px;">Переглянути</a>


                                <a href='project.user.php?pid=<?= $row['id'] ?>' class='btn btn-primary'
                                   style="width: 120px;">Команда</a>
                                <a href='project.executors.php?pid=<?= $row['id'] ?>' class='btn btn-primary'
                                   style="width: 120px;">Виконувачі</a>
                                <a href='project.task.php?pid=<?= $row['id'] ?>' class='btn btn-primary'
                                   style="width: 120px;">Завдання</a>
                                <a href='project.edit.php?pid=<?= $row['id'] ?>' class='btn btn-primary'
                                   style="width: 120px;">Редагування</a>
                                <a href='delete.project.php?pid=<?= $row['id'] ?>' class='btn btn-primary'
                                   style="width: 120px;">Видалення</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <?php
            } else {
                echo "0 result";
            }
            ?>


                <a href='comments/1/index.php' class='btn btn-primary'
                   style="width: 120px;">Коменти</a>
    </div>
<?php require_once __DIR__ . '/layouts/footer.php'; ?>