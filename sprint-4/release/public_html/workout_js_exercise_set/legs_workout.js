


    var exerciseLegsCount = 0;
    var exerciseLegsLimit = 30;
    var LegsSetLimit = 20;
    var LegsExercises = {};



function addExerciseLegs()
    {
        if(exerciseLegsCount <= exerciseLegsLimit)
        {
            exerciseLegsCount++;

            var parentDivLegs = document.getElementById("exercise_Legs_dropdowns");
            var addExerciseLegsButton = document.getElementById("add_exercise_Legs");

            var addSetLegsButton = document.createElement("input");
            addSetLegsButton.type = "button";
            addSetLegsButton.name = "exercise" + exerciseLegsCount + "_add_set_Legs";
            addSetLegsButton.id = "exercise" + exerciseLegsCount + "_add_set_Legs";
            addSetLegsButton.value = '+ Set';
            addSetLegsButton.setAttribute('onclick', 'addSetLegs(this.id)');

            var newDivLegs = document.createElement("div");
            newDivLegs.id = "exercise" + exerciseLegsCount + "_div_Legs";

            var exerciseSelectLegs = document.createElement("select");
            exerciseSelectLegs.name = "exercise" + exerciseLegsCount;

            var br = document.createElement("br");

            parentDivLegs.insertBefore(newDivLegs, addExerciseLegsButton);
            newDivLegs.appendChild(exerciseSelectLegs);
            newDivLegs.appendChild(br);
            newDivLegs.appendChild(addSetLegsButton);
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
                warningDiv.name = "warning_div_Legs";
                var max_exercise_warning = document.createElement("paragraph");
                max_exercise_warning.name = "max_exercise_warning_Legs";
                max_exercise_warning.id = "mew";
                max_exercise_warning.innerHTML = "A workout cannot contain more than 30 exercises";

                parentDivLegs.appendChild(warningDiv);
                warningDiv.appendChild(max_exercise_warning);
            }

        }
    }











    function addSetLegs(exerciseId)
    {
        var exerciseNumLegs = exerciseId.replace('exercise', '').replace('_add_set_Legs', '');
        LegsExercises[exerciseNumLegs + "setCountLegs"] = 0;
        var currentSetCountLegs = LegsExercises[exerciseNumLegs + "setCountLegs"];

        var parentDivLegs = document.getElementById("exercise" + exerciseNumLegs + "_div_Legs");
        var addSetLegsButton = document.getElementById("exercise" + exerciseNumLegs + "_add_set_Legs");

        if(currentSetCountLegs <= LegsSetLimit)
        {
            currentSetCountLegs++;

            var newDivLegs = document.createElement("div");
            newDivLegs.id = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_div_Legs";

            var repsSelectLegs = document.createElement("input");
            repsSelectLegs.type = "number";
            repsSelectLegs.name = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_reps_Legs";
            repsSelectLegs.id = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_reps_Legs";
            repsSelectLegs.setAttribute('min', 1);
            repsSelectLegs.setAttribute('max', 100);
            repsSelectLegs.setAttribute('placeholder', 'reps');

            var weightSelectLegs = document.createElement("input");
            weightSelectLegs.type = "number";
            weightSelectLegs.name = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_weight_Legs";
            weightSelectLegs.id = "exercise" + exerciseNumLegs + "_set_" + currentSetCountLegs + "_weight_Legs";
            weightSelectLegs.setAttribute('min', 0);
            weightSelectLegs.setAttribute('max', 1000);
            weightSelectLegs.setAttribute('step', 5);
            weightSelectLegs.setAttribute('placeholder', 'weight');

            parentDivLegs.insertBefore(newDivLegs, addSetLegsButton);
            newDivLegs.appendChild(repsSelectLegs);
            newDivLegs.appendChild(weightSelectLegs);
        }
    }




