




    var exercisePullCount = 0;
    var exercisePullLimit = 30;
    var PullSetLimit = 20;
    var PullExercises = {};



function addExercisePull()
    {
        if(exercisePullCount <= exercisePullLimit)
        {
            exercisePullCount++;

            var parentDivPull = document.getElementById("exercise_Pull_dropdowns");
            var addExercisePullButton = document.getElementById("add_exercise_Pull");

            var addSetPullButton = document.createElement("input");
            addSetPullButton.type = "button";
            addSetPullButton.name = "exercise" + exercisePullCount + "_add_set_Pull";
            addSetPullButton.id = "exercise" + exercisePullCount + "_add_set_Pull";
            addSetPullButton.value = '+ Set';
            addSetPullButton.setAttribute('onclick', 'addSetPull(this.id)');

            var newDivPull = document.createElement("div");
            newDivPull.id = "exercise" + exercisePullCount + "_div_Pull";

            var exerciseSelectPull = document.createElement("select");
            exerciseSelectPull.name = "exercise" + exercisePullCount;

            var br = document.createElement("br");

            parentDivPull.insertBefore(newDivPull, addExercisePullButton);
            newDivPull.appendChild(exerciseSelectPull);
            newDivPull.appendChild(br);
            newDivPull.appendChild(addSetPullButton);
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
                warningDiv.name = "warning_div_Pull";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_Pull";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivPull.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }











    function addSetPull(exerciseId)
    {
        var exerciseNumPull = exerciseId.replace('exercise', '').replace('_add_set_Pull', '');
        PullExercises[exerciseNumPull + "setCountPull"] = 0;
        var currentSetCountPull = PullExercises[exerciseNumPull + "setCountPull"];

        var parentDivPull = document.getElementById("exercise" + exerciseNumPull + "_div_Pull");
        var addSetPullButton = document.getElementById("exercise" + exerciseNumPull + "_add_set_Pull");

        if(currentSetCountPull <= PullSetLimit)
        {
            currentSetCountPull++;

            var newDivPull = document.createElement("div");
            newDivPull.id = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_div_Pull";

            var repsSelectPull = document.createElement("input");
            repsSelectPull.type = "number";
            repsSelectPull.name = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_reps_Pull";
            repsSelectPull.id = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_reps_Pull";
            repsSelectPull.setAttribute('min', 1);
            repsSelectPull.setAttribute('max', 100);
            repsSelectPull.setAttribute('placeholder', 'reps');

            var weightSelectPull = document.createElement("input");
            weightSelectPull.type = "number";
            weightSelectPull.name = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_weight_Pull";
            weightSelectPull.id = "exercise" + exerciseNumPull + "_set_" + currentSetCountPull + "_weight_Pull";
            weightSelectPull.setAttribute('min', 0);
            weightSelectPull.setAttribute('max', 1000);
            weightSelectPull.setAttribute('step', 5);
            weightSelectPull.setAttribute('placeholder', 'weight');

            parentDivPull.insertBefore(newDivPull, addSetPullButton);
            newDivPull.appendChild(repsSelectPull);
            newDivPull.appendChild(weightSelectPull);
        }
    }




