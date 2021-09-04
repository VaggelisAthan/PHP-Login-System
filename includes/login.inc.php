<?php

//Check if the user accessed login.inc.php through pressing submit

if (isset($_POST['submit'])) {

    // DB connection & Functions file connection.

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Grab Input data

    $username = $_POST["userid"];
    $pwd = $_POST["pwd"];

    // Checking if the user left empty Inputs

    if (emptyInputLogin($username ,$pwd) !== false) {
        header("location: ../login.php?error=emptyinput&userid=$username");
        exit();
    }

    //Login the User

    loginUser($conn, $username, $pwd);
}
else {
    header("location: ../login.php");
    exit();
}