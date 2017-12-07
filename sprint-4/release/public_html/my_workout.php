<?php
    session_start();
?>

<!DOCTYPE html>

<!--
    Donovan Miller and Nathan Ortolan
    This is the users Workout page
-->
<head>
  <title> My Workout </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/src_style.css" />

<!--
These scripts populate the workout tables

  <script src="add_exercise_function.js"></script>

  <script src="add_Warmup.js"></script>
  <script src="add_Push.js"></script>
  <script src="add_Pull.js"></script>
  <script src="add_Legs.js"></script>
  <script src="add_Core.js"></script>

This script is for populating the set of the workouts
  <script src="add_set_function.js"></script>
-->

<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
?>

</head>
<body>
    <!--  
    "main_app is to add CSs around all of the exercise sections."
    -->
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

        <form action="" method="post">
            <div id="view_panel">

            	<input type="date" name="workout_date"><br>
                <!-- 
                These five inputs are tbe exercises types that will call the function specified on the "onclick" attribute. 
                
                -->

                <h3 class = "view_title"> Warmup </h3>
                <div id="exercise_warmup_dropdowns">
                    <input type="button" name="add_exercise_warmup" id="add_exercise_warmup" onclick="addExerciseWarmup()" value="+ Exercise"/>
                </div>



                <h3 class = "view_title"> Push </h3>
                <div id="exercise_push_dropdowns">
                    <input type="button" name="add_exercise_push" id="add_exercise_push" onclick="addExercisePush()" value="+ Exercise"/>
                </div>



                <h3 class = "view_title"> Pull </h3>
                <div id="exercise_pull_dropdowns">
                    <input type="button" name="add_exercise_pull" id="add_exercise_pull" onclick="addExercisePull()" value="+ Exercise"/>
                </div>



                <h3 class = "view_title"> Legs </h3>
                <div id="exercise_legs_dropdowns">
                    <input type="button" name="add_exercise_legs" id="add_exercise_legs" onclick="addExerciseLegs()" value="+ Exercise"/>
                </div>



                <h3 class = "view_title"> Core </h3>
                <div id="exercise_core_dropdowns">
                    <input type="button" name="add_exercise_core" id="add_exercise_core" onclick="addExerciseCore()" value="+ Exercise"/>
                </div>
            </br>
                <div id="submit_workout">
                    <input type="submit" value="Save My Workout" />
                </div>


            </div>
        </form>

<!--
	add field sets
-->

    </div>
</body>
</html>


<!--

Current javascript
10 functions to populate the my_workout page.
5 functions populate the exercises and 5 populate the sets for those exercises

-->


<script type="text/javascript">

// population for the warmup exercise

//these global variables are for addExerciseWarmup and addSetWarmup to keep track 
// of the '+ exercise' and '+ set' buttons
    var exerciseWarmupCount = 0;
    var exerciseWarmupLimit = 30;
    var warmupSetLimit = 20;
    var warmupExercises = {};

// This is the function that will add the '+ exercise' button 
// as well as call the addsetWarmup
function addExerciseWarmup()
    {
        if(exerciseWarmupCount <= exerciseWarmupLimit)
        {
            exerciseWarmupCount++;
            warmupExercises[exerciseWarmupCount + "setCountWarmup"] = 1;

            var parentDivWarmup = document.getElementById("exercise_warmup_dropdowns");
            var addExerciseWarmupButton = document.getElementById("add_exercise_warmup");

            var addSetWarmupButton = document.createElement("input");
            addSetWarmupButton.type = "button";
            addSetWarmupButton.name = "exercise" + exerciseWarmupCount + "_add_set_warmup";
            addSetWarmupButton.id = "exercise" + exerciseWarmupCount + "_add_set_warmup";
            addSetWarmupButton.value = '+ Set';
            addSetWarmupButton.setAttribute('onclick', 'addSetWarmup(this.id)');

            var newDivWarmup = document.createElement("div");
            newDivWarmup.id = "exercise" + exerciseWarmupCount + "_div_warmup";

            var exerciseSelectWarmup = document.createElement("select");
            exerciseSelectWarmup.name = "exercise" + exerciseWarmupCount;

            var br = document.createElement("br");

            parentDivWarmup.insertBefore(newDivWarmup, addExerciseWarmupButton);
            newDivWarmup.appendChild(exerciseSelectWarmup);
            newDivWarmup.appendChild(br);
            addSetWarmup(addSetWarmupButton.id);
            newDivWarmup.appendChild(addSetWarmupButton);
            <?php
                $exercise_query = "SELECT `Exercise`.`exrcise_name`".
                              "FROM `Exercise`".
                              "WHERE `exrcise_type` = 'WARMUP'";
                $result = mysql_query($exercise_query);

                while($exercise = mysql_fetch_assoc($result))
                {
                ?>
                    var option = document.createElement("option");
                    option.value = "<?=$exercise['exrcise_name']?>";
                    option.text = "<?=$exercise['exrcise_name']?>";
                    exerciseSelectWarmup.appendChild(option);
                <?php
                }
                mysql_free_result($result);
            ?>
        }
        else
        {
            if(! document.getElementById("mew"))
            {
                var parentDivWarmup = document.getElementById("main");
                var warningDiv =  document.createElement("div");
                warningDiv.name = "warning_div_warmup";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_warmup";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivWarmup.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }


// this is the function that is called by the addExerciseWarmup to add the "+ set" button.
    function addSetWarmup(exerciseId)
    {
        var exerciseNumWarmup = exerciseId.replace('exercise', '').replace('_add_set_warmup', '');
        var currentSetCountWarmup = warmupExercises[exerciseNumWarmup + "setCountWarmup"];

        var parentDivWarmup = document.getElementById("exercise" + exerciseNumWarmup + "_div_warmup");
        var addSetWarmupButton = document.getElementById("exercise" + exerciseNumWarmup + "_add_set_warmup");

        if(currentSetCountWarmup <= warmupSetLimit)
        {
            warmupExercises[exerciseNumWarmup + "setCountWarmup"]++;

            var newDivWarmup = document.createElement("div");
            newDivWarmup.id = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_div_warmup";

            var repsSelectWarmup = document.createElement("input");
            repsSelectWarmup.type = "number";
            repsSelectWarmup.name = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_reps_warmup";
            repsSelectWarmup.id = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_reps_warmup";
            repsSelectWarmup.setAttribute('min', 1);
            repsSelectWarmup.setAttribute('max', 100);
            repsSelectWarmup.setAttribute('placeholder', 'reps');

            var weightSelectWarmup = document.createElement("input");
            weightSelectWarmup.type = "number";
            weightSelectWarmup.name = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_weight_warmup";
            weightSelectWarmup.id = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_weight_warmup";
            weightSelectWarmup.setAttribute('min', 0);
            weightSelectWarmup.setAttribute('max', 1000);
            weightSelectWarmup.setAttribute('step', 5);
            weightSelectWarmup.setAttribute('placeholder', 'weight');

            parentDivWarmup.insertBefore(newDivWarmup, addSetWarmupButton);
            newDivWarmup.appendChild(repsSelectWarmup);
            newDivWarmup.appendChild(weightSelectWarmup);
        }
    }

// population for the push exercise

//these global variables are for addExercisePush and addSetPush to keep track 
// of the '+ exercise' and '+ set' buttons
    var exercisePushCount = 0;
    var exercisePushLimit = 30;
    var pushSetLimit = 20;
    var pushExercises = {};



function addExercisePush()
    {
        if(exercisePushCount <= exercisePushLimit)
        {
            exercisePushCount++;
            pushExercises[exercisePushCount + "setCountPush"] = 1;

            var parentDivPush = document.getElementById("exercise_push_dropdowns");
            var addExercisePushButton = document.getElementById("add_exercise_push");

            var addSetPushButton = document.createElement("input");
            addSetPushButton.type = "button";
            addSetPushButton.name = "exercise" + exercisePushCount + "_add_set_push";
            addSetPushButton.id = "exercise" + exercisePushCount + "_add_set_push";
            addSetPushButton.value = '+ Set';
            addSetPushButton.setAttribute('onclick', 'addSetPush(this.id)');

            var newDivPush = document.createElement("div");
            newDivPush.id = "exercise" + exercisePushCount + "_div_push";

            var exerciseSelectPush = document.createElement("select");
            exerciseSelectPush.name = "exercise" + exercisePushCount;

            var br = document.createElement("br");

            parentDivPush.insertBefore(newDivPush, addExercisePushButton);
            newDivPush.appendChild(exerciseSelectPush);
            newDivPush.appendChild(br);
            addSetPush(addSetPushButton.id);
            newDivPush.appendChild(addSetPushButton);
            <?php
                $exercise_query = "SELECT `Exercise`.`exrcise_name`".
                              "FROM `Exercise`".
                              "WHERE `exrcise_type` = 'PUSH'";
                $result = mysql_query($exercise_query);

                while($exercise = mysql_fetch_assoc($result))
                {
                ?>
                    var option = document.createElement("option");
                    option.value = "<?=$exercise['exrcise_name']?>";
                    option.text = "<?=$exercise['exrcise_name']?>";
                    exerciseSelectPush.appendChild(option);
                <?php
                }
                mysql_free_result($result);
            ?>
        }
        else
        {
            if(! document.getElementById("mew"))
            {
                var parentDivPush = document.getElementById("main");
                var warningDiv =  document.createElement("div");
                warningDiv.name = "warning_div_push";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_push";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivPush.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }


// this is the function that is called by the addExercisePush to add the "+ set" button.
    function addSetPush(exerciseId)
    {
        var exerciseNumPush = exerciseId.replace('exercise', '').replace('_add_set_push', '');
        var currentSetCountPush = pushExercises[exerciseNumPush + "setCountPush"];

        var parentDivPush = document.getElementById("exercise" + exerciseNumPush + "_div_push");
        var addSetPushButton = document.getElementById("exercise" + exerciseNumPush + "_add_set_push");

        if(currentSetCountPush <= pushSetLimit)
        {
            pushExercises[exerciseNumPush + "setCountPush"]++;

            var newDivPush = document.createElement("div");
            newDivPush.id = "exercise" + exerciseNumPush + "_set_" + currentSetCountPush + "_div_push";

            var repsSelectPush = document.createElement("input");
            repsSelectPush.type = "number";
            repsSelectPush.name = "exercise" + exerciseNumPush + "_set_" + currentSetCountPush + "_reps_push";
            repsSelectPush.id = "exercise" + exerciseNumPush + "_set_" + currentSetCountPush + "_reps_push";
            repsSelectPush.setAttribute('min', 1);
            repsSelectPush.setAttribute('max', 100);
            repsSelectPush.setAttribute('placeholder', 'reps');

            var weightSelectPush = document.createElement("input");
            weightSelectPush.type = "number";
            weightSelectPush.name = "exercise" + exerciseNumPush + "_set_" + currentSetCountPush + "_weight_push";
            weightSelectPush.id = "exercise" + exerciseNumPush + "_set_" + currentSetCountPush + "_weight_push";
            weightSelectPush.setAttribute('min', 0);
            weightSelectPush.setAttribute('max', 1000);
            weightSelectPush.setAttribute('step', 5);
            weightSelectPush.setAttribute('placeholder', 'weight');

            parentDivPush.insertBefore(newDivPush, addSetPushButton);
            newDivPush.appendChild(repsSelectPush);
            newDivPush.appendChild(weightSelectPush);
        }
    }


// population for the pull exercise

//these global variables are for addExercisePull and addSetPull to keep track 
// of the '+ exercise' and '+ set' buttons
    var exercisePullCount = 0;
    var exercisePullLimit = 30;
    var pullSetLimit = 20;
    var pullExercises = {};



function addExercisePull()
    {
        if(exercisePullCount <= exercisePullLimit)
        {
            exercisePullCount++;
            pullExercises[exercisePullCount + "setCountPull"] = 1;

            var parentDivPull = document.getElementById("exercise_pull_dropdowns");
            var addExercisePullButton = document.getElementById("add_exercise_pull");

            var addSetPullButton = document.createElement("input");
            addSetPullButton.type = "button";
            addSetPullButton.name = "exercise" + exercisePullCount + "_add_set_pull";
            addSetPullButton.id = "exercise" + exercisePullCount + "_add_set_pull";
            addSetPullButton.value = '+ Set';
            addSetPullButton.setAttribute('onclick', 'addSetPull(this.id)');

            var newDivPull = document.createElement("div");
            newDivPull.id = "exercise" + exercisePullCount + "_div_pull";

            var exerciseSelectPull = document.createElement("select");
            exerciseSelectPull.name = "exercise" + exercisePullCount;

            var br = document.createElement("br");

            parentDivPull.insertBefore(newDivPull, addExercisePullButton);
            newDivPull.appendChild(exerciseSelectPull);
            newDivPull.appendChild(br);
            addSetPull(addSetPullButton.id);
            newDivPull.appendChild(addSetPullButton);
            <?php
                $exercise_query = "SELECT `Exercise`.`exrcise_name`".
                              "FROM `Exercise`".
                              "WHERE `exrcise_type` = 'PULL'";
                $result = mysql_query($exercise_query);

                while($exercise = mysql_fetch_assoc($result))
                {
                ?>
                    var option = document.createElement("option");
                    option.value = "<?=$exercise['exrcise_name']?>";
                    option.text = "<?=$exercise['exrcise_name']?>";
                    exerciseSelectPull.appendChild(option);
                <?php
                }
                mysql_free_result($result);
            ?>
        }
        else
        {
            if(! document.getElementById("mew"))
            {
                var parentDivPull = document.getElementById("main");
                var warningDiv =  document.createElement("div");
                warningDiv.name = "warning_div_pull";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_pull";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivPull.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }


// this is the function that is called by the addExercisePull to add the "+ set" button.
    function addSetPull(exerciseId)
    {
        var exerciseNumPull = exerciseId.replace('exercise', '').replace('_add_set_pull', '');
        var currentSetCountPull = pullExercises[exerciseNumPull + "setCountPull"];

        var parentDivPull = document.getElementById("exercise" + exerciseNumPull + "_div_pull");
        var addSetPullButton = document.getElementById("exercise" + exerciseNumPull + "_add_set_pull");

        if(currentSetCountPull <= pullSetLimit)
        {
            pullExercises[exerciseNumPull + "setCountPull"]++;

            var newDivPull = document.createElement("div");
            newDivPull.id = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_div_pull";

            var repsSelectPull = document.createElement("input");
            repsSelectPull.type = "number";
            repsSelectPull.name = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_reps_pull";
            repsSelectPull.id = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_reps_pull";
            repsSelectPull.setAttribute('min', 1);
            repsSelectPull.setAttribute('max', 100);
            repsSelectPull.setAttribute('placeholder', 'reps');

            var weightSelectPull = document.createElement("input");
            weightSelectPull.type = "number";
            weightSelectPull.name = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_weight_pull";
            weightSelectPull.id = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_weight_pull";
            weightSelectPull.setAttribute('min', 0);
            weightSelectPull.setAttribute('max', 1000);
            weightSelectPull.setAttribute('step', 5);
            weightSelectPull.setAttribute('placeholder', 'weight');

            parentDivPull.insertBefore(newDivPull, addSetPullButton);
            newDivPull.appendChild(repsSelectPull);
            newDivPull.appendChild(weightSelectPull);
        }
    }


// population for the legs exercise

//these global variables are for addExerciseLegs and addSetLegs to keep track 
// of the '+ exercise' and '+ set' buttons
    var exerciseLegsCount = 0;
    var exerciseLegsLimit = 30;
    var legsSetLimit = 20;
    var legsExercises = {};



function addExerciseLegs()
    {
        if(exerciseLegsCount <= exerciseLegsLimit)
        {
            exerciseLegsCount++;
            legsExercises[exerciseLegsCount + "setCountLegs"] = 1;

            var parentDivLegs = document.getElementById("exercise_legs_dropdowns");
            var addExerciseLegsButton = document.getElementById("add_exercise_legs");

            var addSetLegsButton = document.createElement("input");
            addSetLegsButton.type = "button";
            addSetLegsButton.name = "exercise" + exerciseLegsCount + "_add_set_legs";
            addSetLegsButton.id = "exercise" + exerciseLegsCount + "_add_set_legs";
            addSetLegsButton.value = '+ Set';
            addSetLegsButton.setAttribute('onclick', 'addSetLegs(this.id)');

            var newDivLegs = document.createElement("div");
            newDivLegs.id = "exercise" + exerciseLegsCount + "_div_legs";

            var exerciseSelectLegs = document.createElement("select");
            exerciseSelectLegs.name = "exercise" + exerciseLegsCount;

            var br = document.createElement("br");

            parentDivLegs.insertBefore(newDivLegs, addExerciseLegsButton);
            newDivLegs.appendChild(exerciseSelectLegs);
            newDivLegs.appendChild(br);
            addSetLegs(addSetLegsButton.id);
            newDivLegs.appendChild(addSetLegsButton);
            <?php
                $exercise_query = "SELECT `Exercise`.`exrcise_name`".
                              "FROM `Exercise`".
                              "WHERE `exrcise_type` = 'LEGS'";
                $result = mysql_query($exercise_query);

                while($exercise = mysql_fetch_assoc($result))
                {
                ?>
                    var option = document.createElement("option");
                    option.value = "<?=$exercise['exrcise_name']?>";
                    option.text = "<?=$exercise['exrcise_name']?>";
                    exerciseSelectLegs.appendChild(option);
                <?php
                }
                mysql_free_result($result);
            ?>
        }
        else
        {
            if(! document.getElementById("mew"))
            {
                var parentDivLegs = document.getElementById("main");
                var warningDiv =  document.createElement("div");
                warningDiv.name = "warning_div_legs";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_legs";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivLegs.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }


// this is the function that is called by the addExerciseLegs to add the "+ set" button.
    function addSetLegs(exerciseId)
    {
        var exerciseNumLegs = exerciseId.replace('exercise', '').replace('_add_set_legs', '');
        var currentSetCountLegs = legsExercises[exerciseNumLegs + "setCountLegs"];

        var parentDivLegs = document.getElementById("exercise" + exerciseNumLegs + "_div_legs");
        var addSetLegsButton = document.getElementById("exercise" + exerciseNumLegs + "_add_set_legs");

        if(currentSetCountLegs <= legsSetLimit)
        {
            legsExercises[exerciseNumLegs + "setCountLegs"]++;

            var newDivLegs = document.createElement("div");
            newDivLegs.id = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_div_legs";

            var repsSelectLegs = document.createElement("input");
            repsSelectLegs.type = "number";
            repsSelectLegs.name = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_reps_legs";
            repsSelectLegs.id = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_reps_legs";
            repsSelectLegs.setAttribute('min', 1);
            repsSelectLegs.setAttribute('max', 100);
            repsSelectLegs.setAttribute('placeholder', 'reps');

            var weightSelectLegs = document.createElement("input");
            weightSelectLegs.type = "number";
            weightSelectLegs.name = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_weight_legs";
            weightSelectLegs.id = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_weight_legs";
            weightSelectLegs.setAttribute('min', 0);
            weightSelectLegs.setAttribute('max', 1000);
            weightSelectLegs.setAttribute('step', 5);
            weightSelectLegs.setAttribute('placeholder', 'weight');

            parentDivLegs.insertBefore(newDivLegs, addSetLegsButton);
            newDivLegs.appendChild(repsSelectLegs);
            newDivLegs.appendChild(weightSelectLegs);
        }
    }


// population for the core exercise

//these global variables are for addExerciseCore and addSetCore to keep track 
// of the '+ exercise' and '+ set' buttons
    var exerciseCoreCount = 0;
    var exerciseCoreLimit = 30;
    var CoreSetLimit = 20;
    var coreExercises = {};



function addExerciseCore()
    {
        if(exerciseCoreCount <= exerciseCoreLimit)
        {
            exerciseCoreCount++;
            coreExercises[exerciseCoreCount + "setCountCore"] = 1;

            var parentDivCore = document.getElementById("exercise_core_dropdowns");
            var addExerciseCoreButton = document.getElementById("add_exercise_core");

            var addSetCoreButton = document.createElement("input");
            addSetCoreButton.type = "button";
            addSetCoreButton.name = "exercise" + exerciseCoreCount + "_add_set_core";
            addSetCoreButton.id = "exercise" + exerciseCoreCount + "_add_set_core";
            addSetCoreButton.value = '+ Set';
            addSetCoreButton.setAttribute('onclick', 'addSetCore(this.id)');

            var newDivCore = document.createElement("div");
            newDivCore.id = "exercise" + exerciseCoreCount + "_div_core";

            var exerciseSelectCore = document.createElement("select");
            exerciseSelectCore.name = "exercise" + exerciseCoreCount;

            var br = document.createElement("br");

            parentDivCore.insertBefore(newDivCore, addExerciseCoreButton);
            newDivCore.appendChild(exerciseSelectCore);
            newDivCore.appendChild(br);
            addSetCore(addSetCoreButton.id);
            newDivCore.appendChild(addSetCoreButton);
            <?php
                $exercise_query = "SELECT `Exercise`.`exrcise_name`".
                              "FROM `Exercise`".
                              "WHERE `exrcise_type` = 'CORE'";
                $result = mysql_query($exercise_query);

                while($exercise = mysql_fetch_assoc($result))
                {
                ?>
                    var option = document.createElement("option");
                    option.value = "<?=$exercise['exrcise_name']?>";
                    option.text = "<?=$exercise['exrcise_name']?>";
                    exerciseSelectCore.appendChild(option);
                <?php
                }
                mysql_free_result($result);
            ?>
        }
        else
        {
            if(! document.getElementById("mew"))
            {
                var parentDivCore = document.getElementById("main");
                var warningDiv =  document.createElement("div");
                warningDiv.name = "warning_div_core";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_core";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivCore.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }


// this is the function that is called by the addExerciseCore to add the "+ set" button.
    function addSetCore(exerciseId)
    {
        var exerciseNumCore = exerciseId.replace('exercise', '').replace('_add_set_core', '');
        var currentSetCountCore = coreExercises[exerciseNumCore + "setCountCore"];

        var parentDivCore = document.getElementById("exercise" + exerciseNumCore + "_div_core");
        var addSetCoreButton = document.getElementById("exercise" + exerciseNumCore + "_add_set_core");

        if(currentSetCountCore <= CoreSetLimit)
        {
            coreExercises[exerciseNumCore + "setCountCore"]++;

            var newDivCore = document.createElement("div");
            newDivCore.id = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_div_core";

            var repsSelectCore = document.createElement("input");
            repsSelectCore.type = "number";
            repsSelectCore.name = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_reps_core";
            repsSelectCore.id = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_reps_core";
            repsSelectCore.setAttribute('min', 1);
            repsSelectCore.setAttribute('max', 100);
            repsSelectCore.setAttribute('placeholder', 'reps');

            var weightSelectCore = document.createElement("input");
            weightSelectCore.type = "number";
            weightSelectCore.name = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_weight_core";
            weightSelectCore.id = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_weight_core";
            weightSelectCore.setAttribute('min', 0);
            weightSelectCore.setAttribute('max', 1000);
            weightSelectCore.setAttribute('step', 5);
            weightSelectCore.setAttribute('placeholder', 'weight');

            parentDivCore.insertBefore(newDivCore, addSetCoreButton);
            newDivCore.appendChild(repsSelectCore);
            newDivCore.appendChild(weightSelectCore);
        }
    }


</script>
