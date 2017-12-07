<?php
    session_start();
?>

<!DOCTYPE html>
<!--

    mySQL test connection

    Nathan Ortolan (ndo28)

-->
<head>
    <title> mySQL test </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/src_style.css" />

    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    ?>

</head>

<body>

  <header class="header">
    <h1>mySQL test</h1>
  </header>


  <?php

      $username = "TheCompleteWorko";
      $pw = "Complete459";
      $host = "localhost";
      $db = "TheCompleteWorko";

    /*  $conn = new PDO('mysql:host=localhost;dbname=TheCompleteWorko;charset=utf8mb4', $username, $pw) or die("can't connect"); */

      $conn = mysql_connect($host, $username, $pw, $db) or die("connection failed");
      $db = mysql_select_db($db);

      $exercise_query = "SELECT * FROM Exercise";

    /*  if (!$result = $conn->query($exercise_query)) {
      // Oh no! The query failed.
      echo "Sorry, the website is experiencing problems.";

      // Again, do not do this on a public site, but we'll show you how
      // to get the error information
      echo "Error: Our query failed to execute and here is why: \n";
      echo "Query: " . $sql . "\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
    } */

      $result = mysql_query($exercise_query);

      if (! $result)
      {
          ?>
          <p> Bullshit error </p>
          <?php
          echo('Database error: ' . mysql_error());
      }
      ?>

      <table>
        <tr>
          <th width='40px'> ID </th>
          <th width='175px'> Exercise </th>
          <th width='75px'> Type </th>
        </tr>

        <?php
        while($exercise = mysql_fetch_assoc($result))
        {
        ?>
            <tr>
              <td width='40px' align='center'> <?= $exercise['exrcise_id']?> </td>
              <td width='175px' align='center'> <?= $exercise['exrcise_name']?> </td>
              <td width='75px' align='center'> <?= $exercise['exrcise_type'] ?> </td>
            </tr>
        <?php
        }

        mysql_close($conn);
        ?>

      </table>




</body>
</html>
