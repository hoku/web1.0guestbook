<?php
include_once("config.php");
include_once("funcs.php");

// read inputted data
if (!isset($_POST["comment"])) { header("Location: ./error.php"); exit; }
$paramComment = trim($_POST["comment"]);
if ($paramComment == "") { header("Location: ./"); exit; }

// convert inputted data to internal format
$paramComment = substr($paramComment, 0, 2000);
$paramComment = str_replace("\n", "", $paramComment);
$paramComment = str_replace("\r", "", $paramComment);
$paramComment = htmlspecialchars($paramComment, ENT_QUOTES);
$newPost = date("Y-m-d H:i:s") . CELL_SEP_CHAR . $paramComment;

// read posts
$posts = get_posts(POSTS_FILE_NAME, "./error.php?no=busy");
if ($posts === false) { header("Location: ./error.php"); exit; }
// add new post
array_splice($posts, 0, 0, $newPost);

// remove over limit posts
$nowSize = count($posts);
for ($i = MAX_POSTS_SIZE; $i < $nowSize; $i++) {
	unset($posts);
}

// save posts
$putResult = put_posts($posts);
if ($putResult === false) { header("Location: ./error.php"); exit; }

header("Location: ./");
exit;
