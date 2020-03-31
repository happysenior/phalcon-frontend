var steps = document.querySelectorAll(".step");
var stepBack = document.querySelector(".step-back");
var stepNext = document.querySelector(".step-next");
var bar = document.querySelector(".bar");
var step1btn = document.querySelector(".step1-btn");

var barWidth = [
    "10%",
    "20%",
    "30%",
    "40%",
    "50%",
    "60%",
    "70%",
    "80%",
    "90%",
    "100%"
];

var errors = [
    "No message",
    "Please select the gender",
    "No message",
    "Please select the age",
    "Please select what can your child play on piano",
    "Please confirm if your child can read rhythm symbols",
    "Please confirm if your child can read music",
    "Please select the answer",
    "Please confirm if your child already has a human teacher"
];


var index = 0;

var btnIndex = 0;


function hideSteps() {
    for(var i = 0; i < steps.length; i++) {
        steps[i].classList.add("hide-step");
    }
}

// Hide all steps 
hideSteps();



// SHOW CURRENT STEP WITH INDEX
steps[index].classList.toggle("hide-step");

stepNext.addEventListener("click", function(){
    if (index == steps.length - 1) {

    }
    else {
        var radios = steps[index].querySelectorAll('input[type="radio"]');
        if(radios.length > 0) {
            var radiosChecked = steps[index].querySelectorAll('input[type="radio"]:checked');
            if(radiosChecked.length > 0) {
                var inputs = steps[index].querySelectorAll("input[type='text']");
                if(inputs.length > 0) {
                    if(inputs[0].value.length == 0) {
                        document.querySelector("#error").innerHTML = "Please fill the name of your child";
                    }
                    else {
                        hideSteps();
                        steps[index+1].classList.toggle("hide-step");
                        index++;
                        bar.style.width = barWidth[index];
                        document.querySelector("#error").innerHTML = "";
                    }
                }
                else {
                    hideSteps();
                    steps[index+1].classList.toggle("hide-step");
                    index++;
                    bar.style.width = barWidth[index];
                    document.querySelector("#error").innerHTML = "";
                }
            }
            else {
                document.querySelector("#error").innerHTML = errors[index];
            }
        }
        else {
            hideSteps();
            steps[index+1].classList.toggle("hide-step");
            index++;
            bar.style.width = barWidth[index];
            document.querySelector("#error").innerHTML = "";
        }
    }
});
stepBack.addEventListener("click", function(){
    if(index == 0) {

    }
    else {
        hideSteps();
        steps[index-1].classList.toggle("hide-step");
        index--;
        bar.style.width = barWidth[index];
    }
});


step1btn.addEventListener("click", function() {
    hideSteps();
    steps[1].classList.toggle("hide-step");
    index++;
    bar.style.width = barWidth[1];
});
