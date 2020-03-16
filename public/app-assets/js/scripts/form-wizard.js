// Form Wizard / Stepper

if(document.querySelector('#linearStepper') !== null){
    var linearStepper = document.querySelector('#linearStepper');
    var linearStepperInstace = new MStepper(linearStepper, {
        firstActive: 0,
        showFeedbackPreloader: true,
        // Auto generation of a form around the stepper.
        autoFormCreation: true,
        // Function to be called everytime a nextstep occurs. It receives 2 arguments, in this sequece: stepperForm, activeStepContent.
        // validationFunction: defaultValidationFunction, // more about this default functions below
        // Enable or disable navigation by clicking on step-titles
        stepTitleNavigation: true,
        feedbackPreloader: '<div class="spinner-layer spinner-blue-only">...</div>'
    });

    linearStepperInstace.resetStepper();
}

if(document.querySelector('#horizStepper') !== null){
    var horizStepper = document.querySelector('#horizStepper');
    var horizStepperInstace = new MStepper(horizStepper, {
        // options
        firstActive: 0,
        showFeedbackPreloader: true,
        autoFormCreation: true,
        // validationFunction: defaultValidationFunction,
        stepTitleNavigation: true,
        feedbackPreloader: '<div class="spinner-layer spinner-blue-only">...</div>'
    });

    horizStepperInstace.resetStepper();
}

if(document.querySelector('#nonLinearStepper') !== null){
    var nonLinearStepper = document.querySelector('#nonLinearStepper');
    var nonLinearStepperInstace = new MStepper(nonLinearStepper, {
        // options
        firstActive: 0,
        showFeedbackPreloader: true,
        autoFormCreation: true,
        validationFunction: defaultValidationFunction,
        stepTitleNavigation: true,
        feedbackPreloader: '<div class="spinner-layer spinner-blue-only">...</div>'
    });
}

function validationFunction(stepperForm, activeStepContent) {
    // You can use the 'stepperForm' to valide the whole form around the stepper:
    someValidationPlugin(stepperForm);
    // Or you can do something with just the activeStepContent
    //someValidationPlugin(activeStepContent);
    // Return true or false to proceed or show an error
    return true;
}


function defaultValidationFunction(stepperForm, activeStepContent) {
    var inputs = activeStepContent.querySelectorAll('input, textarea, select');
    for (var i = 0; i < inputs.length; i++) {
        if (!inputs[i].checkValidity()) return false;
    }
    return true;
}

$('.btn-reset').on('click', function () {
    
    if(document.querySelector('#horizStepper') !== null){
        horizStepperInstace.openStep(0);
    }
    
    if(document.querySelector('#linearStepper') !== null){
        linearStepperInstace.openStep(0);
    }

    if(document.querySelector('#nonLinearStepper') !== null){
        nonLinearStepperInstace.openStep(0);
    }
})