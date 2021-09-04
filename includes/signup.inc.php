<?php
//Check if the user accessed signup.inc.php through pressing submit
if (isset($_POST['submit'])) {

    // DB connection & Functions file connection.

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    //Grabbing Input Data

    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $pwdrepeat = mysqli_real_escape_string($conn, $_POST['pwdrepeat']);

    // Checking if the user left empty Inputs

    if (emptyInputSignup($firstName, $lastName , $userid , $email, $pwd, $pwdrepeat) !== false) {
        header("location: ../signup.php?error=emptyinput&firstName=$firstName&lastName=$lastName&userid=$userid&email=$email");
        exit();
    }

    // Checking if the Username is valid

    if (invalidUid($userid) !== false) {
        header("location: ../signup.php?error=invaliduid&firstName=$firstName&lastName=$lastName&email=$email");
        exit();
    }

    //Checking if Email is valid

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail&firstName=$firstName&lastName=$lastName&userid=$userid");
        exit();
    }

    //Chekcing if Password and Password Repeat match

    if (pwdMatch($pwd, $pwdrepeat) !== false) {
        header("location: ../signup.php?error=pwddiffering&firstName=$firstName&lastName=$lastName&userid=$userid&email=$email");
        exit();
    }

    //Checking if Username or Email already exist in DB

    if (uidExists($conn, $userid, $email) !== false) {
        if (uidExists($conn, $userid, $email) == 0) {
            header("location: ../signup.php?error=usernametaken&firstName=$firstName&lastName=$lastName&email=$email");
            exit();
        }
        else {
            header("location: ../signup.php?error=emailtaken&firstName=$firstName&lastName=$lastName&userid=$userid");
            exit();
        }
    }


    //If no errors occur Sign Up the user in DB

    createUser($conn, $firstName, $lastName , $userid , $email, $pwd);
}
else {

    header("location: ../signup.php");
    exit();
}
