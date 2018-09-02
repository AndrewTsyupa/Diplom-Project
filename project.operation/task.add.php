<?php
require __DIR__ . '/__main.libs.php';
require_once __DIR__ . '/model/Project.php';
require_once __DIR__ . '/model/User.php';

$pid = $_GET['pid'];

$is = Project::userIsOwnerOfProject(Session::userId(), $pid);

if (!$is){
    App::dash();
}

$project = Project::findById($pid);

require_once __DIR__ . '/controller/task.add.controller.php';

$title = 'Нове завдання для проекту ' . $project['name'];

require_once __DIR__ . '/layouts/header.php';
?>

<div class="row">
    <div class="col-md-12 ml-auto mr-auto">
        <div class="card card-signup">
            <h2 class="card-title text-center"><?= $title ?></h2>
            <div class="card-body">

                <div class="col-md-12 ml-auto">
                    <h1><?= $error ?></h1>

                    <form class="form-horizontal" style="margin-left: 50px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?pid=<?= $pid ?>" method="POST">

                        <div class="form-group input-group">
                         <span class="input-group-addon">
                             <span class="glyphicon glyphicon-home"></span>
                         </span>
                            <select class="form-control" name="user_id">
                                <?php
                                $users = User::getUsersByProject($pid);
                                foreach ($users as $uid => $user) { ?>
                                    <option value="<?= $uid ?>"><?= $user?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group input-group">
                         <span class="input-group-addon">
                             <span class="glyphicon glyphicon-home"></span>
                         </span>
                            <input type="text" class="form-control" name="name" placeholder="Назва завдання" required>
                        </div>


                        <div class="form-group input-group">
                         <span class="input-group-addon">
                             <span class="glyphicon glyphicon-home"></span>
                         </span>
                            <textarea class="form-control" name="opis" placeholder="Опис завдання" required></textarea>
                        </div>

                        <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                            <input type="text" class="form-control datetimepicker" name="date_start" placeholder="Дата початку" required
                                   data-date-format="DD-MM-YYYY HH:mm"
                                   data-date-locale="uk"
                            >
                        </div>

                        <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                            <input type="text" class="form-control datetimepicker" name="date_end" placeholder="Дата закінчення" required

                                   data-date-format="DD-MM-YYYY HH:mm"
                                   data-date-locale="uk"
                            >
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary" style="width: 100%;" type="submit" name="submit">Створити</button>
                        </div>

                    </form>

                </div>


            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/layouts/footer.php'; ?>