/**
 * Functions used in the main index.php page 
 */

// function used to determine when the html document is ready to be interacted with
function ready(callback) {
    if (document.readyState !== 'loading') {
        callback();
        return;
    }
    document.addEventListener('DOMContentLoaded', callback);
}

// executed when the document is ready
ready(function(){
    // constants
    var MAX_FILE_SIZE = 1000000;
    
    // globals
    var performInlineValidation = true;
    
    // html elements
    var jobForm = document.getElementById("user-request-form");
    var jobName = document.getElementById("job-name");
    var jobScript = document.getElementById("job-script");
    var jobScriptWordcount = document.getElementById("job-script-wordcount");
    var jobCountry = document.getElementById("job-country");
    var jobState = document.getElementById("job-state");
    var browseButton = document.getElementById("browse-button");
    var hiddenBrowseButton = document.getElementById("hidden-browse-button");
    var selectedFilename = document.getElementById("selected-filename");
    var jobBudgets = document.getElementsByName("job-budget");
    var jobBudgetContainer = document.getElementById("budget-container");
    var resetButton = document.getElementById("reset-button");
    var submitButton = document.getElementById("submit-button");

    // event handling
    jobName.addEventListener("blur", function() {
        jobName.value = jobName.value.trim();
        if (performInlineValidation) {
            validateJobName();
        }
    });
    
    jobCountry.addEventListener("change", function() {
        if (performInlineValidation) {
            validateJobCountry();
        }
    });

    jobState.addEventListener("change", function() {
        if (performInlineValidation) {
            validateJobState();
        }
    });
    
    jobBudgetContainer.addEventListener("change", function() {
        if (performInlineValidation) {
            validateJobBudget();
        }
    });
    
    browseButton.addEventListener("click", function(e) {
        hiddenBrowseButton.click();
    });

    // user selected a file
    hiddenBrowseButton.addEventListener("change", function(e) {
        if (this.files[0].size > MAX_FILE_SIZE) {
            alert("That file is just way too big!");
            this.value = "";
        }
        selectedFilename.innerHTML = hiddenBrowseButton.files[0].name;
    });
    
    jobScript.addEventListener("keydown", function(e) {
        updateWordCount(this.value);
    });
        
    resetButton.addEventListener("click", function(e) {
        resetForm();
    });
    
    submitButton.addEventListener("click", function(e) {
        submitForm();
    });
    
    // support functions
    function updateWordCount(script) {
        var words = 0;
        var value = script.trim();
        if (value != "") {
            words = value.split(/\s+/).length;    
        }
        jobScriptWordcount.innerHTML = words;
    }
    
    function validateJobName() {
        jobName.parentNode.classList.remove("error");
        if (jobName.value == "") {
            jobName.parentNode.classList.add("error");
            return false;
        }
        return true;
    }
    
    function validateJobCountry() {
        jobCountry.parentNode.classList.remove("error");
        if (jobCountry.value == "") {
            jobCountry.parentNode.classList.add("error");
            return false;
        }
        return true;
    }
    
    function validateJobState() {
        jobState.parentNode.classList.remove("error");
        if (jobState.value == "") {
            jobState.parentNode.classList.add("error");
            return false;
        }
        return true;
    }
    
    function validateJobBudget() {
        for (var jobBudget of jobBudgets) {
            if (jobBudget.checked) {
                jobBudgetContainer.classList.remove("error");
                return true;
            }    
        }
        jobBudgetContainer.classList.add("error");
        return false;
    }
    
    function validateForm() {
        var valid = true;
        
        valid = validateJobName() && valid;
        valid = validateJobCountry() && valid;
        valid = validateJobState() && valid;
        valid = validateJobBudget() && valid;
        
        if (!valid) {
            setTimeout(function() { alert("You are missing required fields.  Please complete your request before submitting."); }, 100);
        }
        
        return valid;
    }
    
    function submitForm() {
        if (validateForm()) {
            jobForm.submit();
        } else {
            performInlineValidation = true;
        }
    }
    
    function resetForm() {
        var elements = document.getElementsByClassName("error");
        performInlineValidation = false;
        while (elements.length > 0) {
            elements[0].classList.remove("error");
        }
        jobForm.reset();
    }
});