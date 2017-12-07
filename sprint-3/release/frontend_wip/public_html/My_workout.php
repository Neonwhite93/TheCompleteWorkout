<?php
    session_start();
?>

<!DOCTYPE html>
<!--
   Donovan Miller 
   Workout created prototype
-->
<head>
  <title> My Workout </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/src_style.css" />

<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
?>

</head>
<body>

<div id = "main_app">

  <header class="header">
    <h1 id = "app_title" class = "frame_bar"> My Workout </h1>
  </header>

    <?php
      $username = "TheCompleteWorko";
      $pw = "Complete459";
      $host = "localhost";
      $db = "TheCompleteWorko";

      $conn = mysql_connect($host, $username, $pw, $db) or die("connection failed");
      $db = mysql_select_db($db);
    ?>

<!-- Form starts here -->

  <form action="" method="post"> 

   <?php
      /*Result here*/
      /* Selecting only those with exrcise_type of "Warmup" */
     $Warmup_query = "SELECT * FROM Exercise WHERE exrcise_type = 'WARMUP'";
    
      /* Result for Warmup_query */
     $result = mysql_query($Warmup_query);
     
     if (! $result)
     {
   ?>
       <p> Connectivity Error </p>
      <?php
       echo('Database error: ' . mysql_error());
     }
      ?>



  <div id="view_panel">
      <!-- This shows the Workout for the users,
      Set up with one of each category/type Warmup, Push, Pull, Legs, Core -->
    <h3 class = "view_title"> Warmup </h3>
      <div>
        <select name="my_warmup" >

      <?php
          while($exercise = mysql_fetch_assoc($result))
          {
      ?>
            <option value= <?= $exercise['exrcise_name']?>> <?= $exercise['exrcise_name']?> </option>
      <?php
          }

      ?>
        </select> 

<!--

//  <?php
//      /*Result here*/
//      /* Gives the user a list of predetermined sets */

//     $Num_set_query = "SELECT * FROM Exercise WHERE exrcise_type = 'WARMUP'";
//   
//     /* Result for Warmup_query */
//     $result = mysql_query($Warmup_query);
     
//     if (! $result)
//     {
//   ?>
//       <p> Connectivity Error </p>
//      <?php
//       echo('Database error: ' . mysql_error());
//     }
//      ?>

-->
      
<!-- 
      The number of sets the user has done
-->  
     <div>
       <label> Sets: </label> 
         <input type="number" value="0" name="NumOfSets" /> 
     </div>
<!-- 
      Lists the exercise reps and weight by 
      how many sets are requested
-->
        <ul style="list-style-type: none">
      
          
      <li>  rep  |  weight  </li>

        </ul>

  </div>
  



  <?php
       /*Result here*/
       /* Selecting only those with exrcise_type of "Push" */
     $Push_query = "SELECT * FROM Exercise WHERE exrcise_type = 'PUSH'";

       /* Result for Push_query */
     $result = mysql_query($Push_query);

     if (! $result)
     {
   ?>
       <p> Connectivity Error </p>
   <?php
       echo('Database error: ' . mysql_error());
     }
   ?>

    <h3 class = "view_title"> Push </h3>
      <div>
        <select name="my_push" >
   <?php
        while($exercise = mysql_fetch_assoc($result))
        {
    ?>
          <option value= <?= $exercise['exrcise_name']?>> <?= $exercise['exrcise_name']?> </option>
    <?php
        }
    ?>
        </select>

        <ul>
        
        
      <li>  rep  |  weight</li>
        
        
        </ul>

      </div>
   <?php

      /*Result here*/
      /* Selecting only those with exrcise_type of "Pull" */
      $Pull_query = "SELECT * FROM Exercise WHERE exrcise_type = 'PULL'";

      /* Result for Push_query */
      $result = mysql_query($Pull_query);

      if (! $result)
      {
    ?>
        <p> Connectivity Error </p>
    <?php
        echo('Database error: ' . mysql_error());
      }
    ?>

    <h3 class = "view_title"> Pull </h3>
      <div>
        <select name="my_pull" >
    <?php
        while($exercise = mysql_fetch_assoc($result))
        {
    ?>
          <option value= <?= $exercise['exrcise_name']?>> <?= $exercise['exrcise_name']?> </option>
    <?php
        }
    ?>
        </select>

        <ul>
        
        
      <li>  rep  |  weight</li>
        
        
        </ul>


      </div>
    <?php
      /*Result here*/
      /* Selecting only those with exrcise_type of "Push" */
     $Legs_query = "SELECT * FROM Exercise WHERE exrcise_type = 'LEGS'";

      /* Result for Push_query */
     $result = mysql_query($Legs_query);

      if (! $result)
      {
    ?>
        <p> Connectivity Error </p>
    <?php
          echo('Database error: ' . mysql_error());
      }
    ?>

    <h3 class = "view_title"> Legs </h3>
      <div>
        <select name="my_legs" >

    <?php
        while($exercise = mysql_fetch_assoc($result))
        {
    ?>
          <option value= <?= $exercise['exrcise_name']?>> <?= $exercise['exrcise_name']?> </option>
    <?php
        }
    ?>
        </select>

        <ul>
        
        
      <li>  rep  |  weight</li>
        
        
        </ul>


      </div>
    <?php
        /* Result here */
        /* Selecting only those with exrcise_type of "Push" */
       $Core_query = "SELECT * FROM Exercise WHERE exrcise_type = 'CORE'";

        /* Result for Push_query */
       $result = mysql_query($Core_query);

      if (! $result)
      {
    ?>
        <p> Connectivity Error </p>
    <?php
        echo('Database error: ' . mysql_error());
      }
   ?>

    <h3 class = "view_title"> Core </h3>
      <div>
        <select name="my_core" >

    <?php
        while($exercise = mysql_fetch_assoc($result))
        {
    ?>
          <option value= <?= $exercise['exrcise_name']?>> <?= $exercise['exrcise_name']?> </option>
    <?php
        }
  
        mysql_close($conn);
    ?>
        </select>

        <ul>
        
        
      <li>  rep  |  weight</li>
        
        
        </ul>

      </div>
    </div>
  </form>

</div>    
</body>
</html>