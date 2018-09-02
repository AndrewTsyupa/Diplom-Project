<?php
require __DIR__ . '/__main.libs.php';
require __DIR__ . '/model/Comment.php';
require __DIR__ . '/model/Task.php';
require __DIR__ . '/model/Project.php';

$comment = Comment::findById($_GET['id']);

if ($comment && $comment['user_id'] == Session::userId()){
    Comment::delete($comment['id'], Session::userId());
}