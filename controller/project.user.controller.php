<?php



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




 $c = $_SESSION['user']['id'] == $project['owner_id'];
  if(!$c){
      header("Location: /dash.php");
      die();
 }





?>
