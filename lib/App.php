<?php

class App {

    public static function redirect($url) {
        header("Location: /" . $url);
        die();
    }

    public static function dash() {
        header("Location: /dash.php");
        die();
    }

}