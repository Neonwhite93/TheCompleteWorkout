<?php
    session_start();
?>

<!DOCTYPE html>
<!--

    mySQL login test connection

    Nathan Ortolan (ndo28)

-->
<html>
<head>
    <title> Login Test </title>
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
    <h1>Login Test</h1>
  </header>


  <?php

      $username = "TheCompleteWorko";
      $pw = "Complete459";
      $host = "localhost";
      $db = "TheCompleteWorko";

      $conn = mysql_connect($host, $username, $pw, $db) or die("connection failed");
      $db = mysql_select_db($db);

      if(! isset($_POST['login']))
      {
      ?>
          <form method="post">
              <input type="text" name="user" placeholder="username"><br>
              <input type="password" name="pw" placeholder="password"><br>
              <input type="submit" name="login">
          </form>

      <?php
      }
      else
      {
          $user = $_POST['user'];
          $pass = $_POST['pw'];

          $user_query = "SELECT *".
                        "FROM `User`".
                        "WHERE `username` = '$user'";
          $result = mysql_query($user_query);

          if (! $result)
          {
              ?>
              <p> User not found </p>
              <?php
          }
          else
          {
              $found_user = mysql_fetch_assoc($result);
              if($found_user['password'] != $pass)
              {
                  ?>
                  <p> username/password combination invalid </p>
                  <?php
              }
              else
              {
                  ?>
                  <p> Welcome, <?= $found_user['f_name'] ?>! </p>
                  <?php
              }
              mysql_free_result($result);
          }
      }


      mysql_close($conn);
      ?>

</body>
</html>
