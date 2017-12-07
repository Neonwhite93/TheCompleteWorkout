<?php
    session_start();
?>

<!DOCTYPE html>
<!--

    create workout test

    Nathan Ortolan (ndo28)

-->
<html>
<head>
    <title> Create Workout Test</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/src_style.css" />
    <script src="create_workout_scripts.php"></script>

    <?php
      error_reporting(-1);
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
    ?>
</head>

<body>

  <header class="header">
    <h1>Create Workout Test</h1>
  </header>

  <?php
      $username = "TheCompleteWorko";
      $pw = "Complete459";
      $host = "localhost";
      $db = "TheCompleteWorko";

      $conn = mysql_connect($host, $username, $pw, $db) or die("connection failed");
      $db = mysql_select_db($db);

      $user = "test157";
  ?>

  <div id="main">
    <form method="post" id="workout_form">
        <input type="text" name="workout_name" placeholder="Workout Name"><br>
        <input type="date" name="workout_date"><br>
        <div id="exercise_dropdowns">
            <input type="button" name="add_exercise" id="add_exercise" onclick="addExercise()" value="+ Exercise"/>
        </div>
    </form>
  </div>

</body>
</html>
