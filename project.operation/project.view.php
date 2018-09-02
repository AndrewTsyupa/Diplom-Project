<?php
require __DIR__ . '/__main.libs.php';

require __DIR__ . '/model/Project.php';
require __DIR__ . '/model/Task.php';
require __DIR__ . '/model/User.php';
require_once __DIR__ . '/controller/user.edit.controller.php';
require_once __DIR__ . '/controller/task.edit.controller.php';

$pid = $_GET['pid'];
$project = Project::findById($pid);

if (!$project) {
    App::dash();
}

$p = Project::userCanView(Session::userId(), $pid);

if (!$p) {
    App::dash();
}

$projectId = $project['id'];

$chartData = Project::chart($projectId);
$chartData = json_encode($chartData);

$title = 'Проект: ' . $project['name'];

require_once __DIR__ . '/layouts/header.php' ?>

<div class="row">
    <div class="col-md-12 ml-auto mr-auto">
        <div class="card card-signup">
            <h2 class="card-title text-center"><?= $title ?></h2>
            <div class="card-body">

                <?php if (Session::isAdmin()) {?>
                <a href='project.team.php?pid=<?= $projectId?>' class='btn btn-warning'>Виконувачі</a>
                <?php } ?>


                <a href='project.tasks.php?pid=<?= $projectId?>' class='btn btn-warning' >Завдання</a>

                <div class="col-md-12 ml-auto">
                    <span>Назва: <?= $project["name"]; ?></span>
                    <span>Дата: <?= $project["date_start"]; ?> - <?= $project["date_stop"]; ?></span>
                </div>


                <script src="/js/chart.bundle.js"></script>
                <script src="/js/utils.js"></script>


                <div class="col-sm-12">
                    <canvas id="chart"></canvas>
                </div>


                <script>

                    $(function(){

                        var config = {
                            type: 'line',
                            data: <?= $chartData ?>,
                            options: {
                                responsive: true,
                                title: {
                                    display: true,
                                    text: 'Години по проекту'
                                },
                                tooltips: {
                                    mode: 'index',
                                    intersect: false,
                                },
                                hover: {
                                    mode: 'nearest',
                                    intersect: true
                                },
                                scales: {
                                    xAxes: [{
                                        display: true,
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Місяці'
                                        }
                                    }],
                                    yAxes: [{
                                        display: true,
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Години'
                                        },
                                        ticks: {
                                            min: 0,
                                            //max: 100,

                                            // forces step size to be 5 units
                                            stepSize: 5
                                        }
                                    }]
                                }
                            }
                        };


                        var ctx = document.getElementById('chart').getContext('2d');
                        window.myLine = new Chart(ctx, config);
                    })

                </script>


                <h2>Учасники</h2>

                <a href='/project.zaprositi.user.php?pid=<?= $projectId ?>' class='btn btn-success'><i
                            class="fas fa-plus"></i> Додати учасника</a>

                <table class="table table-bordered table-hover ">

                    <thead>
                    <tr align="center">
                        <th scope="col">Імя</th>
                        <th scope="col">Прізвище</th>
                        <th scope="col">Email</th>
                        <th scope="col">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = DB::queryAll("SELECT user.*, p.status FROM project_team AS p INNER JOIN user WHERE p.project_id = $pid and p.user_id = user.id;");

                    if(count($result) > 0) {
                        foreach ($result as $row){ ?>
                            <tr align="center">
                                <td><?= $row['first_name']?></td>
                                <td><?= $row['last_name']?></td>
                                <td><?= $row['email']?></td>
                                <td>
                                    <?= $row['status'] == 0?'Ще не прийняв':'' ?>

                                    <?php if ($row['status'] == 0) { ?>

                                <?php if ($row['id'] == Session::userId()){ ?>

                                        <a href='/project.accept.php?pid=<?= $project['id'] ?>' class='btn btn-primary'">Прийняти</a>
                                            <a href='/project.leave.php?pid=<?= $project['id'] ?>' class='btn btn-primary'">Вийти</a>
                                        <?php } ?>
                                <?php } else { ?>

                                    <?php if ($row['id'] == Session::userId()){ ?>
                                        <a href='/project.leave.php?pid=<?= $project['id'] ?>' class='btn btn-primary'">Вийти</a>
                                    <?php } ?>

                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                    </tbody>
                </table>

                <h2>Завдання</h2>

                <a class="btn btn-success" href="/task.add.php?pid=<?= $pid ?>"><i class="fas fa-plus"></i> Додати
                    завдання</a>

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr align="center">
                        <th scope="col">Номер</th>
                        <th scope="col">Виконувач</th>
                        <th scope="col">Назва завдання</th>
                        <th scope="col">Опис</th>
                        <th scope="col">Час початку</th>
                        <th scope="col">Час закінчення</th>
                    </tr>
                    </thead>
                    <?php

                    $uId = Session::potochnuiUser()['id'];

                    $tasks = Task::listTasks($uId, $pid);

                    if (count($tasks) > 0) {
                        foreach ($tasks as $task) { ?>
                            <tr align="center">
                                <td><?= $task['id'] ?></td>
                                <td><?= $task['user'] ?></td>
                                <td><?= $task['name'] ?></td>
                                <td><?= $task['opis'] ?></td>
                                <td><?= $task['date_start'] ?></td>
                                <td><?= $task['date_end'] ?></td>
                            </tr>
                        <?php }
                    }
                    ?>
                </table>


            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/layouts/footer.php' ?>
