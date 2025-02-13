<?php
    require "./mvc/index.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voices Demo</title>
    
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="stylesheet" href="css/index.css" />
    
    <script src="js/index.js"></script>
    
    <script>
    <?php
    $message = "";
    $details = "";
    if (isset($_SESSION["error"])) {
        $message = "We are unable to save your project request.";
        $details = "ERROR: '" . $_SESSION["error"] . "'";
    } else if (isset($_SESSION["job-name"])) {
        $message = "You have successfully saved your project request.";
        $details = "Project Request: '" . $_SESSION["job-name"] . "'";
    }
    if ($message != "") {
    ?>
        alert("<?php echo $message; ?>\n\n<?php echo $details; ?>");
    <?php    
    } 
    ?>
    </script>
</head>
<body>
    <div id="container">
        <div id="title-container">
            <div class="vertical-aligner">
                <span id="title-text">Let us know your project requirements</span>
            </div>
        </div>
        <div id="userinput-container">
            <form id="user-request-form" enctype="multipart/form-data" method="POST" onsubmit="return false;">
                <div id="job-name-container" class="field-container full">
                    <label class="field-label" for="job-name">What's your project's name?</label>
                    <label class="field-sublabel" for="job-name">Provide a short descriptive title to attract talent.</label>
                    <input type="text" maxlength="200" placeholder="For example, '30 Second Radio Spot' or 'Corporate Training Video'" id="job-name" name="job-name" />
                    <div class="error-text">Project Name is Required.</div>
                </div>
                <div id="job-script-container" class="field-container full">
                    <label class="field-label" for="job-script">Small Script <span class="field-label-suffix">Optional</span></label>
                    <label class="field-sublabel" for="job-script">Include a small piece of a script you would like talent to read.</label>
                    <textarea maxlength="2000" placeholder="Type or paste a sample script here." id="job-script" name="job-script"></textarea>
                    <div class="field-footer"><span id="job-script-wordcount">0</span> words</div>
                </div>
                <div id="job-country-container" class="field-container left">
                    <label class="field-label" for="job-country">Country</label>
                    <select id="job-country" name="job-country" required>
                        <option value="" disabled selected hidden>Select your country</option>
                        <?php 
                            foreach ($model["countries"] as $country) {
                                echo "<option value='$country[id]'>$country[name]</option>";
                            }    
                        ?>
                    </select>
                    <div class="error-text">Country is Required.</div>
                </div>
                <div id="job-state-container" class="field-container right">
                    <label class="field-label" for="job-state">State/Province</label>
                    <select id="job-state" name="job-state" required>
                        <option value="" disabled selected hidden>Select your province</option>
                        <?php 
                            foreach ($model["states"] as $state) {
                                echo "<option country_id='$state[country]' value='$state[id]'>$state[name]</option>";
                            }
                        ?>
                    </select>
                    <div class="error-text">State/Province is Required.</div>
                </div>
                <div id="job-file-container" class="field-container full">
                    <label class="field-label" for="job-file">Please upload your reference file here <span class="field-label-suffix">Optional</span></label>
                    <label class="field-sublabel" for="job-file">(Max 20mb)</label>
                    <input type="file" class="hidden" name="job-file" id="hidden-browse-button"/>
                    <button type="button" id="browse-button">Browse for Files</button>
                    <span id="selected-filename"></span>
                </div>
                <div id="budget-container" class="field-container full">
                    <label class="field-label" for="job-budget">What's your budget?</label>
                    <label class="field-sublabel" for="job-budget">Minimum project cost is $5 USD</label>
                    <?php 
                        foreach ($model["budgets"] as $budget) {
                    ?>  
                    <label class="radio-container">
                    <?php
                        echo "$" . $budget["minimum"] . " - $" . $budget["maximum"]; 
                    ?>
                        <input name="job-budget" type="radio" value="<?php echo $budget['id'] ?>"/>
                        <span class="checkmark"></span>
                    </label>
                    <?php        
                        }
                    ?>
                    <div class="error-text">A Budget is Required.</div>
                </div>
                <div id="button-container">
                    <button type="button" name="reset-button" id="reset-button">Reset</button>
                    <button type="button" name="submit-button" id="submit-button">Submit</button>
                </div>
            </form>        
        </div>
    
    </div>
</body>
</html>
<?php 
    session_unset();
    session_destroy();
?>