<?php
require __DIR__ . '/__main.libs.php';

$title = 'Новий проект';

require_once __DIR__ . '/controller/project.controller.php';

require_once __DIR__ . '/layouts/header.php'; ?>

<div class="row">
    <div class="col-md-5 ml-auto mr-auto">
        <div class="card card-signup">
            <h2 class="card-title text-center"><?= $title ?></h2>
            <div class="card-body">

                <div class="col-md-12 ml-auto">

                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

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

                            <input type="text" class="form-control datetimepicker" name="date_start" placeholder="Дата початку" required

                                   data-date-format="DD-MM-YYYY HH:mm"
                                   data-date-locale="uk"
                            >
                        </div>

                        <div class="form-group input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </span>

                            <input type="text" class="form-control datetimepicker" name="date_stop" placeholder="Дата закінчення" required



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

