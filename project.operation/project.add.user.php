    <?php

    require_once __DIR__ . '/lib/DB.php';
    require_once __DIR__ . '/model/Project.php';
    require_once __DIR__ . '/model/User.php';


    $pid = isset($_GET['pid'])?$_GET['pid']:false;

    if (!$pid){
        header("Location: /dash.php");
        die();
    }

    $project = Project::findById($pid);

    if (!$project){
        header("Location: /dash.php");
        die();
    }

    $uid = isset($_GET['uid'])?$_GET['uid']:false;

    if (!$uid){
        header("Location: /dash.php");
        die();
    }

    $user = User::findById($uid);


    $status = Project::addUserToProject($project['id'], $user['id']);

    if ($status){
        header("Location: /dash.php?pid=" . $project['id']);
        die();
    }