<?php
include_once('Post.php');
$post = new Post();
$title = $_POST['title'];
$content = $_POST['content'];
$post->addPost($title, $content);
echo 'Post bien ajouté';
echo $title . ' ' . $content ;