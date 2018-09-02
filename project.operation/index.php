<?php
require __DIR__ . '/lib/App.php';
require __DIR__ . '/lib/Session.php';

Session::start();

if (Session::inSystem()){
    App::dash();
}

require 'layouts/home_header.php';
?>

<style>

    .m-btn {
        background: none;
        border: 1px solid #fff;
        width: 250px;
        border-radius: 0;
    }

    .m-btn:hover,
    .m-btn:focus
    {
        transition: all 1s;
        border: 1px solid #fff;
        background: rgba(255, 255, 255, 0.4);
    }

</style>

<div class="page-header header-filter" data-parallax="true" style="background-image: url('/assets/img/profile_city.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title text-center">Все починається з завдання</h1>
                <h4 class="text-center"></h4>
                <br>

                <div class="text-center">

                    <a href="/registration.php" class="btn btn-raised btn-lg m-btn">
                        <i class="fa fa-play"></i> Зареєструватися
                    </a>

                    <a href="/login.php" class="btn btn-raised btn-lg m-btn">
                        <i class="fa fa-play"></i> Увійти
                    </a>

                </div>


            </div>
        </div>
    </div>
</div>

<?php require 'layouts/home_footer.php'; ?>


