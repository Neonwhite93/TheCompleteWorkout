<!DOCTYPE html>

<html>

	<head>

		<title>The Complete Workout</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/src_style.css" />
		<link rel="stylesheet" type="text/css" href="css/accordion.css" />

		<!-- "unobtrusive" JS -->
		<script src="src_main.js" type="text/javascript"
            defer="defer">
		</script>

	</head>

	<body>

	<?php
		$username = "TheCompleteWorko";
		$pw = "Complete459";
		$host = "localhost";
		$db = "TheCompleteWorko";

		$conn = mysql_connect($host, $username, $pw, $db) or die("connection failed");
		$db = mysql_select_db($db);
	?>

		<h1 id = "app_title" class = "frame_bar" >The Complete Workout</h1>

		<div id = "view_panel">

			<h2 class = "view_title"> Exercises </h2>

			<button class="accordion"> Warmup </button>
			<div class="panel scroll">
				<ul>
					<?php
					$type = 'WARMUP';
					$warmup_exercise_query = "SELECT *".
														"FROM  `Exercise`".
														"WHERE  `exrcise_type` =  '$type'".
														"AND  `html_loc` !=  ''".
														"LIMIT 0 , 30";
					$result = mysql_query($warmup_exercise_query);

					if (! $result)
					{
							echo('Database error: ' . mysql_error());
					}

					while($exercise = mysql_fetch_assoc($result))
					{
					?>
							<li class="ex_link">
								<a href=<?= $exercise['html_loc'] ?>>
								<div class="ex_button">
									<h3><?= $exercise['exrcise_name'] ?></h3>
								</div>
								</a>
							</li>
					<?php
					}
					mysql_free_result($result);
					?>
				</ul>
			</div>

			<button class="accordion">Legs</button>
			<div class="panel scroll">
				<ul>
					<?php
					$type = 'LEGS';
					$legs_exercise_query = "SELECT *".
														"FROM  `Exercise`".
														"WHERE  `exrcise_type` =  '$type'".
														"AND  `html_loc` !=  ''".
														"LIMIT 0 , 30";
					$result = mysql_query($legs_exercise_query);

					if (! $result)
					{
							echo('Database error: ' . mysql_error());
					}

					while($exercise = mysql_fetch_assoc($result))
					{
					?>
							<li class="ex_link">
								<a href=<?= $exercise['html_loc'] ?>>
								<div class="ex_button">
									<h3><?= $exercise['exrcise_name'] ?></h3>
								</div>
								</a>
							</li>
					<?php
					}
					mysql_free_result($result);
					?>
				</ul>
			</div>

			<button class="accordion">Push</button>
			<div class="panel scroll">
				<ul>
					<?php
					$type = 'PUSH';
					$push_exercise_query = "SELECT *".
														"FROM  `Exercise`".
														"WHERE  `exrcise_type` =  '$type'".
														"AND  `html_loc` !=  ''".
														"LIMIT 0 , 30";
					$result = mysql_query($push_exercise_query);

					if (! $result)
					{
							echo('Database error: ' . mysql_error());
					}

					while($exercise = mysql_fetch_assoc($result))
					{
					?>
							<li class="ex_link">
								<a href=<?= $exercise['html_loc'] ?>>
								<div class="ex_button">
									<h3><?= $exercise['exrcise_name'] ?></h3>
								</div>
								</a>
							</li>
					<?php
					}
					mysql_free_result($result);
					?>
				</ul>
			</div>

			<button class="accordion">Pull</button>
			<div class="panel scroll">
				<ul>
					<?php
					$type = 'PULL';
					$pull_exercise_query = "SELECT *".
														"FROM  `Exercise`".
														"WHERE  `exrcise_type` =  '$type'".
														"AND  `html_loc` !=  ''".
														"LIMIT 0 , 30";
					$result = mysql_query($pull_exercise_query);

					if (! $result)
					{
							echo('Database error: ' . mysql_error());
					}

					while($exercise = mysql_fetch_assoc($result))
					{
					?>
							<li class="ex_link">
								<a href=<?= $exercise['html_loc'] ?>>
								<div class="ex_button">
									<h3><?= $exercise['exrcise_name'] ?></h3>
								</div>
								</a>
							</li>
					<?php
					}
					mysql_free_result($result);
					?>
				</ul>
			</div>

			<button class="accordion">Core</button>
			<div class="panel scroll">
				<ul>
					<?php
					$type = 'CORE';
					$core_exercise_query = "SELECT *".
														"FROM  `Exercise`".
														"WHERE  `exrcise_type` =  '$type'".
														"AND  `html_loc` !=  ''".
														"LIMIT 0 , 30";
					$result = mysql_query($core_exercise_query);

					if (! $result)
					{
							echo('Database error: ' . mysql_error());
					}

					while($exercise = mysql_fetch_assoc($result))
					{
					?>
							<li class="ex_link">
								<a href=<?= $exercise['html_loc'] ?>>
								<div class="ex_button">
									<h3><?= $exercise['exrcise_name'] ?></h3>
								</div>
								</a>
							</li>
					<?php
					}
					mysql_free_result($result);
					mysql_close($conn);
					?>
				</ul>
			</div>

		</div>

	</body>

</html>
