




    var exerciseCoreCount = 0;
    var exerciseCoreLimit = 30;
    var CoreSetLimit = 20;
    var CoreExercises = {};



function addExerciseCore()
    {
        if(exerciseCoreCount <= exerciseCoreLimit)
        {
            exerciseCoreCount++;

            var parentDivCore = document.getElementById("exercise_Core_dropdowns");
            var addExerciseCoreButton = document.getElementById("add_exercise_Core");

            var addSetCoreButton = document.createElement("input");
            addSetCoreButton.type = "button";
            addSetCoreButton.name = "exercise" + exerciseCoreCount + "_add_set_Core";
            addSetCoreButton.id = "exercise" + exerciseCoreCount + "_add_set_Core";
            addSetCoreButton.value = '+ Set';
            addSetCoreButton.setAttribute('onclick', 'addSetCore(this.id)');

            var newDivCore = document.createElement("div");
            newDivCore.id = "exercise" + exerciseCoreCount + "_div_Core";

            var exerciseSelectCore = document.createElement("select");
            exerciseSelectCore.name = "exercise" + exerciseCoreCount;

            var br = document.createElement("br");

            parentDivCore.insertBefore(newDivCore, addExerciseCoreButton);
            newDivCore.appendChild(exerciseSelectCore);
            newDivCore.appendChild(br);
            newDivCore.appendChild(addSetCoreButton);
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
                warningDiv.name = "warning_div_Core";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_Core";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivCore.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }











    function addSetCore(exerciseId)
    {
        var exerciseNumCore = exerciseId.replace('exercise', '').replace('_add_set_Core', '');
        CoreExercises[exerciseNumCore + "setCountCore"] = 0;
        var currentSetCountCore = CoreExercises[exerciseNumCore + "setCountCore"];

        var parentDivCore = document.getElementById("exercise" + exerciseNumCore + "_div_Core");
        var addSetCoreButton = document.getElementById("exercise" + exerciseNumCore + "_add_set_Core");

        if(currentSetCountCore <= CoreSetLimit)
        {
            currentSetCountCore++;

            var newDivCore = document.createElement("div");
            newDivCore.id = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_div_Core";

            var repsSelectCore = document.createElement("input");
            repsSelectCore.type = "number";
            repsSelectCore.name = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_reps_Core";
            repsSelectCore.id = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_reps_Core";
            repsSelectCore.setAttribute('min', 1);
            repsSelectCore.setAttribute('max', 100);
            repsSelectCore.setAttribute('placeholder', 'reps');

            var weightSelectCore = document.createElement("input");
            weightSelectCore.type = "number";
            weightSelectCore.name = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_weight_Core";
            weightSelectCore.id = "exercise" + exerciseNumCore + "_set_" + currentSetCountCore + "_weight_Core";
            weightSelectCore.setAttribute('min', 0);
            weightSelectCore.setAttribute('max', 1000);
            weightSelectCore.setAttribute('step', 5);
            weightSelectCore.setAttribute('placeholder', 'weight');

            parentDivCore.insertBefore(newDivCore, addSetCoreButton);
            newDivCore.appendChild(repsSelectCore);
            newDivCore.appendChild(weightSelectCore);
        }
    }




