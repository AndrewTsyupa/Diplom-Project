<?php
require __DIR__ . '/__main.libs.php';
require __DIR__ . '/model/Task.php';

$tid = $_GET['tid'];
$task = Task::findById($tid);

$title = 'Редагування таску: ' . $task['name'];

require_once __DIR__ . '/layouts/header.php' ?>

<style>
    .modal-backdrop {
        z-index: 0!important;
    }
</style>

<div class="row">
    <div class="col-md-12 ml-auto mr-auto">
        <div class="card card-signup">
            <h2 class="card-title text-center"><?= $title ?></h2>
            <div class="card-body">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    Зазвітувати години
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Години по проекту</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form class="form-horizontal" method="post" action="/task.add.hours.php?id=<?= $task['id'] ?>">

                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" placeholder="Додати години" name="hodini">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control datetimepicker" placeholder="Дата" name="date"
                                                   data-date-format="DD-MM-YYYY HH:mm"
                                                   data-date-locale="uk">
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                                <button type="submit" class="btn btn-success">Додати</button>
                            </div>

                            </form>


                        </div>
                    </div>
                </div>



                <div class="col-md-12 ml-auto">

                    <form class="form-horizontal">
                        <table class="table">

                            <thead>
                            <tr>
                                <td><label for="inputPassword6">Назва завдання</label></td>
                                <td><label for="exampleInputPassword1"><?= $task["name"]; ?></label></td>
                            </tr>

                            <tr>
                                <td><label for="inputPassword6">Ваші години по проекту</label></td>
                                <td><label for="exampleInputPassword1"><?= Task::getHodini($task['id']) ?></label></td>
                            </tr>

                            <tr>
                                <td><label for="inputPassword6">Опис завдання </label></td>
                                <td><label for="exampleInputPassword1"><?= $task["opis"]; ?></label></td>
                            </tr>

                            <tr>
                                <td><label for="inputPassword6">Дата початку </label></td>
                                <td><label for="exampleInputPassword1"><?= $task["date_start"]; ?></label></td>
                            </tr>

                            <tr>
                                <td><label for="inputPassword6">Дата закінчення </label></td>
                                <td><label for="exampleInputPassword1"><?= $task["date_end"]; ?></label></td>
                            </tr>


                            </thead>
                        </table>
                    </form>

                </div>


            </div>
        </div>

        <div class="card">
            <div class="card-body" id="list-comments">

                <?php
                $tId = $task['id'];
                require __DIR__ . '/_comments_list.php'
                ?>

            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <h6>Додати коментар:</h6>
                        <div class="clearfix"></div>
                        <textarea class="form-control" id="comment"></textarea>
                        <p>
                            <a class="float-right btn btn-outline-primary ml-2 btn-comment"> Надіслати</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



<script>
    window.task_id = '<?= $task['id']?>';

    $(function () {

        $('.btn-comment').click(function(){
            $.ajax({
                method: "POST",
                url: "/task.add.comment.php",
                data: {
                    task_id: window.task_id,
                    comment:  $('#comment').val()
                }
            }).done(function(data) {
                $('#list-comments').append(data);
                $('#comment').val('')
            });
        });


        $('.btn-del-comm').click(function(e){
            e.preventDefault();
            var el = $(this);

            $.get('/task.comment.delete.php?id=' + $(el).data('last_id'), function (data) {
                $(el).closest('div.comment').remove();
            });
        });

    });
</script>


<?php require_once __DIR__ . '/layouts/footer.php' ?>
