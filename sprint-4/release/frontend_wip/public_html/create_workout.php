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
    <title> Create Workout Test </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/src_style.css" />

    <?php
      error_reporting(E_ALL);
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

  if(! isset($_POST['submit']))
  {
      $exercise_count = 1;
  ?>
      <form method="post">
            <input type="text" name="workout_name" placeholder="Workout Name"><br>
            <input type="date" name="workout_date"><br>
            <div id="exercise_dropdowns">
              <div id="<?=$exercise_count?>" onclick="selectDiv(this)">
                <select name="exercise<?=$exercise_count?>" id="exercise<?=$exercise_count?>">
                    <?php
                        $exercise_query = "SELECT `Exercise`.`exrcise_name`".
                                      "FROM `Exercise`";
                        $result = mysql_query($exercise_query);

                        while($exercise = mysql_fetch_assoc($result))
              					{
              					?>
              							<option value="<?=$exercise['exrcise_name']?>">
              									<?= $exercise['exrcise_name'] ?>
              							</option>
              					<?php
              					}
              					mysql_free_result($result);
                    ?>
                </select><br>
                <input type="button" value="+ Set" onclick="addSet()">
              </div>
            </div>

            <input type="button" name="add_exercise" value="+ Exercise" onclick="addExercise()">
            <input type="submit" name="submit" value="Create Workout">
        </form>
    <?php
    }
    ?>
</body>
</html>

<script>
  function addExercise()
  {
      <?php
      $exercise_count++;
      $current_exercise = $excercise_count;
      $exercise${current_exercise}_set_count = 1;
      ?>
      var exercises = document.getElementById("exercise_dropdowns");
      var new_div = document.createElement("div");
      new_div.id = "<?=$current_exercise?>";
      new_div.onclick = "newDiv(this)"
      exercises.appendChild(new_div);
      var new_select = document.createElement("select");
      new_select.id = "exercise<?=$current_exercise?>";
      new_select.name = "exercise<?=$current_exercise?>";
      new_div.appendChild(new_select);

      <?php
          $exercise_query = "SELECT `Exercise`.`exrcise_name`".
                        "FROM `Exercise`";
          $result = mysql_query($exercise_query);

          while($exercise = mysql_fetch_assoc($result))
          {
          ?>
              var option = document.createElement("option");
              option.value = "<?=$exercise['exrcise_name']?>";
              option.text = "<?=$exercise['exrcise_name']?>";
              new_select.appendChild(option);
          <?php
          }
          mysql_free_result($result);
      ?>
      var br = document.createElement("br");
      exercises.appendChild(br);
  }

  function addSet()
  {
      var div = document.getElementById("<?=$current_exercise?>");
      var exercise = <?=$current_exercise?>;
      var set = <?=$exercise${current_exercise}_set_count?>;

      var new_weight = document.createElement("input");
      new_weight.type = "text";
      new_weight.name = exercise + "." + set + ".weight";
      new_weight.id = exercise + "." + set + ".weight";
      var new_reps = document.createElement("input");
      new_reps.type = "text";
      new_reps.name = exercise + "." + set + ".reps";
      new_reps.id = exercise + "." + set + ".reps";

      div.appendChild(new_weight);
      div.appendChild(new_reps);

      <?php
        $exercise${current_exercise}_set_count++;
      ?>
  }

  function selectDiv(object)
  {
      <?php
        $current_exercise = $object;
      ?>
  }
</script>

<?php
mysql_close($conn);
?>
