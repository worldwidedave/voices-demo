<?php
    require_once(__DIR__ . "/../lib/db.php");

    session_start();
    
    // fake mvc 
    $model = array();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        post();
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        get();
    }

    function post() {
        // save the job name to the session for later
        $_SESSION["job-name"] = $_POST["job-name"];
    
        $name = $_POST["job-name"];
        $script = $_POST["job-script"];
        $countryId = $_POST["job-country"];
        $stateId = $_POST["job-state"];
        $filename = $_FILES["job-file"]["name"];
        $budgetId = $_POST["job-budget"];
        
        // save all the data to the database
        $db = new db();
        
        $insert = $db->query("INSERT INTO request (name, script, country_id, state_id, filename, budget_id) VALUES (?, ?, ?, ?, ?, ?)",
                             $name, $script, $countryId, $stateId, $filename, $budgetId);
        if ($insert->affectedRows() == 1) {
            if ($filename != "") {
                if (move_uploaded_file($_FILES["job-file"]["tmp_name"], DIR_UPLOAD . "/" . $db->lastInsertID())) {
                    // send a confirmation / summary email
                    mail(EMAIL_JOBS_CONFIRMATION, 
                         "Request '" . $name . "' Created.", 
                         "Request '" . $name . "' Created.  Boilerplate Boilerplate"); 
                } 
            }    
        } else {
            // if we failed, save the error in the session
            $_SESSION["error"] = "Database Insert Error";
            error_log("Database Insert Error");
        }
        
        // redirect so that we do not inadvertantly double save on reload of page
        header("HTTP/1.1 303 See Other");
        header("Location: http://$_SERVER[HTTP_HOST]/index.php");
        exit();
    }    

    function get() {
        global $model;

        $db = new db();
        $model["countries"] = $db->query("SELECT id, name FROM country WHERE active = true")->fetchAll();
        $model["states"] = $db->query("SELECT id, name FROM state WHERE active = true")->fetchAll();
        $model["budgets"] = $db->query("SELECT id, minimum, maximum FROM budget WHERE active = true")->fetchAll();
    }
