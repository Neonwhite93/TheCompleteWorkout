




    var exercisePushCount = 0;
    var exercisePushLimit = 30;
    var pushSetLimit = 20;
    var pushExercises = {};



function addExercisePush()
    {
        if(exercisePushCount <= exercisePushLimit)
        {
            exercisePushCount++;

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
            newDivPush.appendChild(addSetPushButton);
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











    function addSetPush(exerciseId)
    {
        var exerciseNumPush = exerciseId.replace('exercise', '').replace('_add_set_push', '');
        pushExercises[exerciseNumPush + "setCountPush"] = 0;
        var currentSetCountPush = pushExercises[exerciseNumPush + "setCountPush"];

        var parentDivPush = document.getElementById("exercise" + exerciseNumPush + "_div_push");
        var addSetPushButton = document.getElementById("exercise" + exerciseNumPush + "_add_set_push");

        if(currentSetCountPush <= pushSetLimit)
        {
            currentSetCountPush++;

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




