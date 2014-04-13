<?php

function get_posts() {
	$posts = @file_get_contents(POSTS_FILE_NAME);
	if ($posts === false && file_exists(POSTS_FILE_NAME)) {
		return false;
	}
	$posts = explode(LINE_SEP_CHAR, $posts);
	if ($posts[0] == "") {
		$posts = array();
	}
	return $posts;
}

function put_posts($posts) {
	return @file_put_contents(POSTS_FILE_NAME, implode(LINE_SEP_CHAR, $posts), LOCK_EX);
}

function update_counter() {
	$nowCount = false;
	for ($i = 0; $i < 20; $i++) {
		$nowCount = @file_get_contents(COUNTER_FILE_NAME);
		if ($nowCount === false) {
			if (file_exists(COUNTER_FILE_NAME)) {
				usleep(10000);
			} else {
				@file_put_contents(COUNTER_FILE_NAME, 1, LOCK_EX);
				return 1;
			}
		} else {
			break;
		}
	}
	if ($nowCount === false) {
		return 0;
	} else {
		$nowCount = intval($nowCount) + 1;
		@file_put_contents(COUNTER_FILE_NAME, $nowCount, LOCK_EX);
	}
	return $nowCount;
}
