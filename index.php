<?php
include_once("config.php");
include_once("funcs.php");

$nowCount = update_counter();
$posts = get_posts();
if ($posts === false) { header("Location: ./error.php"); exit; }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<title>Web1.0Guestbook</title>
	<style>
	html,body {
		padding: 0px;
		margin: 0px;
		-webkit-text-size-adjust: 100%;
		color: 444;
		background-color: #eee;
		height: 100%;
	}
	#header {
		padding: 8px;
	}
	#contents {
		padding: 8px;
	}
	#footer {
		font-size: 0.8em;
		padding: 8px;
		color: #fff;
		background-color: #333;
		text-align: right;
	}
	h1 {
		font-size: 1.2em;
	}
	.sub-title {
		font-size: 0.8em;
		color: #888;
	}
	a {
		color:#eee;
	}
	form {
		padding: 0px;
		margin: 0px;
	}
	hr {
		border: 0;
		height: 1px;
		background: #ccc;
	}
	.comm-date {
		font-size: 0.8em;
		color: #888;
	}
	.comm-main {
		padding: 4px;
		word-break: break-all;
	}
	</style>
</head>
<body>
	<div id="header">
		<h1>Web1.0 Guestbook</h1>
		<?php echo $nowCount; ?> visitors
		<p class="sub-title">
			Wellcome!!
		</p>
	</div>

	<div id="contents">
		<form action="write.php" method="post">
			Comment:<input type="text" name="comment" maxlength="120"><br>
			<input type="submit" value="Submit">
		</form>
		<?php
			foreach ($posts as $post) {
				echo "<hr>";
				$cells = explode(CELL_SEP_CHAR, $post);
				echo "<div class='comm-date'>" . $cells[0] . "</div>";
				echo "<div class='comm-main'>" . $cells[1] . "</div>";
			}
		?>
	</div>

	<div id="footer">
		<!-- Allow that you want to hide this link. -->
		<a href="http://hoku.in/">hoku.in</a>
	</div>
</body>
</html>
