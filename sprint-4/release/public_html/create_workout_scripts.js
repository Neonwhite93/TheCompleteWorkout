

    var exerciseCount = 0;
    var exerciseLimit = 30;
    var setLimit = 20;
    var exercises = {};

    function addExercise()
    {
        if(exerciseCount <= exerciseLimit)
        {
            exerciseCount++;

            var parentDiv = document.getElementById("exercise_dropdowns");
            var addExerciseButton = document.getElementById("add_exercise");

            var addSetButton = document.createElement("input");
            addSetButton.type = "button";
            addSetButton.name = "exercise" + exerciseCount + "_add_set";
            addSetButton.id = "exercise" + exerciseCount + "_add_set";
            addSetButton.value = '+ Set';
            addSetButton.setAttribute('onclick', 'addSet(this.id)');

            var newDiv = document.createElement("div");
            newDiv.id = "exercise" + exerciseCount + "_div";

            var exerciseSelect = document.createElement("select");
            exerciseSelect.name = "exercise" + exerciseCount;

            var br = document.createElement("br");

            parentDiv.insertBefore(newDiv, addExerciseButton);
            newDiv.appendChild(exerciseSelect);
            newDiv.appendChild(br);
            newDiv.appendChild(addSetButton);
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
                    exerciseSelect.appendChild(option);
                <?php
                }
                mysql_free_result($result);
            ?>
        }
        else
        {
            if(! document.getElementById("mew"))
            {
                var parentDiv = document.getElementById("main");
                var warningDiv =  document.createElement("div");
                warningDiv.name = "warning_div";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDiv.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }



    function addSet(exerciseId)
    {
        var exerciseNum = exerciseId.replace('exercise', '').replace('_add_set', '');
        exercises[exerciseNum + "setCount"] = 0;
        var currentSetCount = exercises[exerciseNum + "setCount"];

        var parentDiv = document.getElementById("exercise" + exerciseNum + "_div");
        var addSetButton = document.getElementById("exercise" + exerciseNum + "_add_set");

        if(currentSetCount <= setLimit)
        {
            currentSetCount++;

            var newDiv = document.createElement("div");
            newDiv.id = "exercise" + exerciseNum + "_set_" + currentSetCount + "_div";

            var repsSelect = document.createElement("input");
            repsSelect.type = "number";
            repsSelect.name = "exercise" + exerciseNum + "_set_" + currentSetCount + "_reps";
            repsSelect.id = "exercise" + exerciseNum + "_set_" + currentSetCount + "_reps";
            repsSelect.setAttribute('min', 1);
            repsSelect.setAttribute('max', 100);
            repsSelect.setAttribute('placeholder', 'reps');

            var weightSelect = document.createElement("input");
            weightSelect.type = "number";
            weightSelect.name = "exercise" + exerciseNum + "_set_" + currentSetCount + "_weight";
            weightSelect.id = "exercise" + exerciseNum + "_set_" + currentSetCount + "_weight";
            weightSelect.setAttribute('min', 0);
            weightSelect.setAttribute('max', 1000);
            weightSelect.setAttribute('step', 5);
            weightSelect.setAttribute('placeholder', 'weight');

            parentDiv.insertBefore(newDiv, addSetButton);
            newDiv.appendChild(repsSelect);
            newDiv.appendChild(weightSelect);
        }
    }
