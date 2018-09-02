<?php
require __DIR__ . '/__main.libs.php';

require_once __DIR__ . '/model/Project.php';
require_once __DIR__ . '/model/User.php';

//require_once __DIR__ . '/project.add.user.php';

$pid = $_GET["pid"];
$project = Project::findById($pid);


$title = 'Запросити в проект ' . $project['name'];
require_once __DIR__ . '/layouts/header.php';
?>

<div class="row">
    <div class="col-md-12 ml-auto mr-auto">
        <div class="card card-signup">
            <h2 class="card-title text-center"><?= $title ?></h2>
            <div class="card-body">

                <div class="col-md-12 ml-auto">

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

                        $uid = Session::potochnuiUser()['id'];

                        $result = DB::queryAll("SELECT u.*, pt.id as is_added FROM user u left JOIN project_team pt ON u.id = pt.user_id AND pt.project_id = $pid WHERE u.id <> $uid");

                        if(count($result) > 0){
                            foreach ($result as $row){ ?>

                                <tr align="center">
                                    <td><?= $row['id']?></td>
                                    <td><?= $row['first_name']?></td>
                                    <td><?= $row['last_name']?></td>
                                    <td><?= $row['email']?></td>
                                    <td>
                                        <?php if ($row['is_added']) { ?>
                                            Added
                                        <?php } else { ?>
                                            <a href='/project.add.user.php?uid=<?= $row['id'] ?>&pid=<?= $project['id'] ?>' class='btn btn-primary'">Додати</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }?>

                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>