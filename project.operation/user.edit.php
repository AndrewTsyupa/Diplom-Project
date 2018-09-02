<?php
require __DIR__ . '/lib/Session.php';
Session::start();

if (!Session::inSystem()) {
    header("Location: /login.php");
    die();
}

$uid = $_SESSION['user']['id'];
require_once __DIR__ . '/lib/DB.php';
require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/model/Task.php';
require_once __DIR__ . '/model/LoginForm.php';
require_once __DIR__ . '/controller/user.edit.controller.php';





$uid = $_GET['uid'];
$user = User::findById($uid);

?>
<?php require_once __DIR__ . '/layouts/header.php'; ?>
<div class="container-fluid" align="center">

    <div class="col-sm-10" style="width: 1000px;margin-top: 50px;">
        <div class="jumbotron">
            <div class="form-group" style="margin-top: -50px;">
                <div align="center">
                    <h1 style="">Редагування даних користувача - <?= $user['first_name']; ?></h1>
                </div>

            </div>
            <hr>

            <form class="form-horizontal" style="margin-left: 50px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?pid=" method="POST">

                <div class="form-group">
                    <label for="exampleInputEmail1">Назва проекту</label>
                    <input type="text" class="form-control"  name="first_name" aria-describedby="text" placeholder="" value="<?= $user['first_name'] ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Дата початку</label>
                    <input type="text" class="form-control"  name="last_name" placeholder="" value="<?= $user['last_name'] ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Дата кінця</label>
                    <input type="text" class="form-control"  name="email" placeholder="" value="<?= $user['email'] ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Пароль</label>
                    <input type="text" class="form-control"  name="password" placeholder="" value="<?= $user['password'] ?>">
                </div>

                <div align="center">
                    <button type="submit" name="submit" class="btn btn-primary" style="width: 150px">Зберегти</button>
                </div>
            </form>

        </div>

        <?php require_once __DIR__ . '/layouts/footer.php'; ?>

