<?php

$sql = "
SELECT
  c.*,
  concat(u.first_name, ' ', u.last_name) AS username
FROM comment c INNER JOIN user u ON c.user_id = u.id
WHERE task_id = $tid
";

$comments = DB::queryAll($sql);

$userId = Session::userId();

foreach ($comments as $comment) {

    $lastId = $userId == $comment['user_id']? $comment['id']:false;
    $time = $comment['created'];
    $text = $comment['comment'];
    $username = $comment['username'];

    require __DIR__ . '/_comment.php';
}