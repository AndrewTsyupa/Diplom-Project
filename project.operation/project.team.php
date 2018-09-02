<?php
require __DIR__ . '/__main.libs.php';

require_once __DIR__ . '/model/Project.php';
require_once __DIR__ . '/model/User.php';

$pid = $_GET["pid"];
$project = Project::findById($pid);

$title = 'Учасники проекту - ' .  $project['name'];
require_once __DIR__ . '/layouts/header.php'; ?>


<div class="row">
    <div class="col-md-12 ml-auto mr-auto">
        <div class="card card-signup">
            <h2 class="card-title text-center"><?= $title ?></h2>
            <div class="card-body">

                <div class="col-md-12 ml-auto">

                    <a class="btn btn-success" href="/project.zaprositi.user.php?pid=<?= $pid ?>"><i class="fas fa-plus"></i> Додати учасника</a>

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr align="center">
                            <th scope="col">Імя</th>
                            <th scope="col">Прізвище</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>

                        <?php
                        $result = DB::queryAll("SELECT user.* FROM project_team AS p INNER JOIN user WHERE p.project_id = $pid and p.user_id = user.id;");

                        if(count($result) > 0){
                            foreach ($result as $row){ ?>
                                <tr align="center">
                                    <td><?= $row['first_name']?></td>
                                    <td><?= $row['last_name']?></td>
                                    <td><?= $row['email']?></td>
                                    <td><a href='/project.delete.user.php?uid=<?= $row['id'] ?>&pid=<?= $pid ?>' class='btn btn-primary'>Видалити</a><br></td>
                                </tr>
                                <?php
                            }
                        } ?>
                    </table>

                </div>


            </div>
        </div>
    </div>
</div>



<?php require_once __DIR__ . '/layouts/footer.php'; ?>



