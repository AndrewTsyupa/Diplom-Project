<?php
require __DIR__ . '/__main.libs.php';
require __DIR__ . '/model/Task.php';
require __DIR__ . '/model/Project.php';
require_once __DIR__ . '/controller/task.edit.controller.php';

$pid = $_GET['pid'];
$project = Project::findById($pid);

$title = 'Завдання для проекту - ' .  $project['name'];
require_once __DIR__ . '/layouts/header.php' ?>

<div class="row">
    <div class="col-md-12 ml-auto mr-auto">
        <div class="card card-signup">
            <h2 class="card-title text-center"><?= $title ?></h2>
            <div class="card-body">

                <div class="col-md-12 ml-auto">

                    <?php if (Session::isAdmin()) { ?>
                    <a class="btn btn-success" href="/task.add.php?pid=<?= $pid ?>"><i class="fas fa-plus"></i> Додати завдання</a>
                    <?php } ?>

                    <table class="table table-bordered table-hover">

                        <thead>
                        <tr align="center">
                            <th scope="col">Номер</th>
                            <th scope="col">Виконувач</th>
                            <th scope="col">Назва завдання</th>
                            <th scope="col">Опис</th>
                            <th scope="col">Час початку</th>
                            <th scope="col">Час закінчення</th>
                            <th scope="col">Статус</th>
                        </tr>
                        </thead>
                        <?php

                        $uId = Session::userId();

                        $tasks = Task::listTasks($uId, $pid);

                        if (count($tasks) > 0) {
                            foreach ($tasks as $task) { ?>

                                <tr align="center">
                                    <td><?= $task['id'] ?></td>
                                    <td><?= $task['user'] ?></td>
                                    <td><?= $task['name'] ?></td>
                                    <td width="100px;"><?= $task['opis'] ?></td>
                                    <td><?= $task['date_start'] ?></td>
                                    <td><?= $task['date_end'] ?></td>
                                    <td><?= $task['status']?'Активний':'Закритий' ?></td>

                                    <td width="400px;">
                                        <a href='task.view.php?tid=<?= $task['id'] ?>' class='btn btn-info' data-toggle="tooltip" data-placement="top" title="" data-container="body" data-original-title="Переглянути"><i class="fas fa-eye"></i></a>
                                        <?php if ($task['owner']){ ?>
                                        <a href='task.edit.php?tid=<?= $task['id'] ?>' class='btn btn-default' data-toggle="tooltip" data-placement="top" title="" data-container="body" data-original-title="Редагувати"><i class="fas fa-edit"></i></a>

                                        <?php
                                            $status = (int)!$task['status'];

                                            if ($task['status']) {
                                                $title = 'Закрити';
                                                $btnStatus = 'warning';
                                                $iconStatus = 'window-close';
                                            } else {
                                                $title = 'Відкрити';
                                                $btnStatus = 'success';
                                                $iconStatus = 'window-restore';
                                            }
                                        ?>

                                        <a href='task.status.php?tid=<?= $task['id'] ?>&status=<?=$status ?>' class='btn btn-<?= $btnStatus ?>' data-toggle="tooltip" data-placement="top" title="" data-container="body" data-original-title="<?= $title ?>"><i class="fas fa-<?= $iconStatus ?>"></i></a>
                                        <a href='task.delete.php?tid=<?= $task['id'] ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" title="" data-container="body" data-original-title="Видалити"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                        <?php } ?>
                                </tr>
                            <?php }
                        }
                        ?>
                    </table>

                </div>


            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php' ?>