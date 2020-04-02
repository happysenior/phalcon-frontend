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


function hideNextBtn(num) {
    if(num == 0) {
        stepNext.style.display = "none";
    }
    else if (num == 1) {
        stepNext.style.display = "none";
    }
    else if (num == 2) {
        stepNext.style.display = "block";
    }
    else if (num == 3) {
        stepNext.style.display = "none";
    }
    else if (num == 4) {
        stepNext.style.display = "none";
    }
    else if (num == 5) {
        stepNext.style.display = "block";
    }
    else if (num == 6) {
        stepNext.style.display = "block";
    }
    else if (num == 7) {
        stepNext.style.display = "none";
    }
    else if (num == 8) {
        stepNext.style.display = "none";
    }
    else if (num == 9) {
        stepNext.style.display = "none";
    }
}

hideNextBtn(index);


function hideSteps() {
    for(var i = 0; i < steps.length; i++) {
        steps[i].classList.add("hide-step");
    }
}

// Hide all steps 
hideSteps();

function nextStep() {
    hideSteps();
    steps[index+1].classList.toggle("hide-step");
    index++;
    hideNextBtn(index);
    bar.style.width = barWidth[index];
    document.querySelector("#error").innerHTML = "";
}

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
                        nextStep();
                    }
                }
                else {
                    nextStep();
                }
            }
            else {
                document.querySelector("#error").innerHTML = errors[index];
            }
        }
        else {
            nextStep();
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
        hideNextBtn(index);
        bar.style.width = barWidth[index];
    }
});


step1btn.addEventListener("click", function() {
    hideSteps();
    steps[1].classList.toggle("hide-step");
    index++;
    hideNextBtn(index);
    bar.style.width = barWidth[1];
});

var boyImage = document.querySelector(".step3 .boy-image");
var girlImage = document.querySelector(".step3 .girl-image");

var step2choices = document.querySelectorAll(".step2 label");
for(var i = 0; i < step2choices.length; i++) {
    step2choices[i].style.pointerEvents = "none";
    step2choices[i].style.opacity = "0.5";
}
    step2choices[0].addEventListener("click", function() {
        boyImage.style.display = "none";
        girlImage.style.display = "block";
        nextStep();
    });
    step2choices[1].addEventListener("click", function() {
        girlImage.style.display = "none";
        boyImage.style.display = "block";
        nextStep();
    });


var step2input = document.querySelector(".step2 input[type='text']");
var childNames = document.querySelectorAll(".slider .child-name");

function checkStep2() {
    var inputValue = step2input.value.trim();
    console.log(inputValue);
    for (var i = 0; i < childNames.length; i++) {
        childNames[i].innerHTML = inputValue;
    }
    if(inputValue.length > 1) {
        for(var i = 0; i < step2choices.length; i++) {
            step2choices[i].style.pointerEvents = "all";
            step2choices[i].style.opacity = "0.8";
        }
    }
    else {
        for(var i = 0; i < step2choices.length; i++) {
            step2choices[i].style.pointerEvents = "none";
            step2choices[i].style.opacity = "0.5";
        }
    }
}

    var step4choices = document.querySelectorAll(".step4 label");
    for (var i = 0; i < step4choices.length; i++) {
        step4choices[i].addEventListener("click", function(){
            nextStep();
        });
    }

    var step5choices = document.querySelectorAll(".step5 label");
    for (var i = 0; i < step5choices.length; i++) {
        step5choices[i].addEventListener("click", function(){
            nextStep();
        });
    }
    var step8choices = document.querySelectorAll(".step8 label");
    for (var i = 0; i < step8choices.length; i++) {
        step8choices[i].addEventListener("click", function(){
            nextStep();
        });
    }
    var step9choices = document.querySelectorAll(".step9 label");
    for (var i = 0; i < step9choices.length; i++) {
        step9choices[i].addEventListener("click", function(){
            nextStep();
        });
    }
    var step10choices = document.querySelectorAll(".step10 label");
    for (var i = 0; i < step10choices.length; i++) {
        step10choices[i].addEventListener("click", function(){
            nextStep();
        });
    }





