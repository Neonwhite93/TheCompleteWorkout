





    var exerciseWarmupCount = 0;
    var exerciseWarmupLimit = 30;
    var WarmupSetLimit = 20;
    var WarmupExercises = {};



function addExerciseWarmup()
    {
        if(exerciseWarmupCount <= exerciseWarmupLimit)
        {
            exerciseWarmupCount++;

            var parentDivWarmup = document.getElementById("exercise_Warmup_dropdowns");
            var addExerciseWarmupButton = document.getElementById("add_exercise_Warmup");

            var addSetWarmupButton = document.createElement("input");
            addSetWarmupButton.type = "button";
            addSetWarmupButton.name = "exercise" + exerciseWarmupCount + "_add_set_Warmup";
            addSetWarmupButton.id = "exercise" + exerciseWarmupCount + "_add_set_Warmup";
            addSetWarmupButton.value = '+ Set';
            addSetWarmupButton.setAttribute('onclick', 'addSetWarmup(this.id)');

            var newDivWarmup = document.createElement("div");
            newDivWarmup.id = "exercise" + exerciseWarmupCount + "_div_Warmup";

            var exerciseSelectWarmup = document.createElement("select");
            exerciseSelectWarmup.name = "exercise" + exerciseWarmupCount;

            var br = document.createElement("br");

            parentDivWarmup.insertBefore(newDivWarmup, addExerciseWarmupButton);
            newDivWarmup.appendChild(exerciseSelectWarmup);
            newDivWarmup.appendChild(br);
            newDivWarmup.appendChild(addSetWarmupButton);
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
                warningDiv.name = "warning_div_Warmup";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_Warmup";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivWarmup.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }











    function addSetWarmup(exerciseId)
    {
        var exerciseNumWarmup = exerciseId.replace('exercise', '').replace('_add_set_Warmup', '');
        WarmupExercises[exerciseNumWarmup + "setCountWarmup"] = 0;
        var currentSetCountWarmup = WarmupExercises[exerciseNumWarmup + "setCountWarmup"];

        var parentDivWarmup = document.getElementById("exercise" + exerciseNumWarmup + "_div_Warmup");
        var addSetWarmupButton = document.getElementById("exercise" + exerciseNumWarmup + "_add_set_Warmup");

        if(currentSetCountWarmup <= WarmupSetLimit)
        {
            currentSetCountWarmup++;

            var newDivWarmup = document.createElement("div");
            newDivWarmup.id = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_div_Warmup";

            var repsSelectWarmup = document.createElement("input");
            repsSelectWarmup.type = "number";
            repsSelectWarmup.name = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_reps_Warmup";
            repsSelectWarmup.id = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_reps_Warmup";
            repsSelectWarmup.setAttribute('min', 1);
            repsSelectWarmup.setAttribute('max', 100);
            repsSelectWarmup.setAttribute('placeholder', 'reps');

            var weightSelectWarmup = document.createElement("input");
            weightSelectWarmup.type = "number";
            weightSelectWarmup.name = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_weight_Warmup";
            weightSelectWarmup.id = "exercise" + exerciseNumWarmup + "_set_" + currentSetCountWarmup + "_weight_Warmup";
            weightSelectWarmup.setAttribute('min', 0);
            weightSelectWarmup.setAttribute('max', 1000);
            weightSelectWarmup.setAttribute('step', 5);
            weightSelectWarmup.setAttribute('placeholder', 'weight');

            parentDivWarmup.insertBefore(newDivWarmup, addSetWarmupButton);
            newDivWarmup.appendChild(repsSelectWarmup);
            newDivWarmup.appendChild(weightSelectWarmup);
        }
    }




