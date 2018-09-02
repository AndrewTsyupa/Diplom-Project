<?php
require __DIR__ . '/__main.libs.php';
require_once __DIR__ . '/model/Project.php';

$pid = $_GET['pid'];
Project::deleteProject($pid);
App::dash();