<?php
require __DIR__ . '/lib/App.php';
require __DIR__ . '/lib/DB.php';
require __DIR__ . '/lib/Session.php';
Session::start();

if (!Session::inSystem()) {
    App::redirect('login.php');
}
