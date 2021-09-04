<?php

//------------------------------------------- Signup.inc.php Functions-------------------------------------------

// Checks if any input is empty in signup.php

function emptyInputSignup($firstName, $lastName , $userid , $email, $pwd, $pwdrepeat) {
    $result;
    if (empty($firstName) || empty($lastName) || empty($userid) || empty($email) || empty($pwd) || empty($pwdrepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Checks if the Username is Valid in signup.php

function invalidUid($userid) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $userid)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
// Checks if the email is Valid in signup.php

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Checks if Password and the Repeat Password match in signup.php

function pwdMatch($pwd, $pwdrepeat) {
    $result;
    if ($pwd !== $pwdrepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Checks if Username already exists in DB

function uidExists($conn, $userid, $email) {
    $sql = "SELECT * FROM users WHERE user_uid = ? OR  user_email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt,"ss", $userid, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            //return $row;
            if ($row['user_uid'] == $userid) {
                $result = 0;
            }
            elseif ($row['user_email'] == $email) {
                $result = 1;
            }
            return $result;
        }
        else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }


}

// Creates New User in DB

function createUser($conn, $firstName, $lastName , $userid , $email, $pwd) {
    $sql = "INSERT INTO users (user_fname, user_lname, user_email, user_uid, user_pwd) VALUES (? , ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    else {

        //Password Hashing

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


        mysqli_stmt_bind_param($stmt,"sssss", $firstName, $lastName, $email, $userid, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../signup.php?error=none");
        exit();
    }
}



//------------------------------------------- Login.inc.php Functions-------------------------------------------

// Checks if any input is empty

function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Logs in the User

function loginUser($conn, $username, $pwd) {
    $sql="SELECT * FROM users WHERE user_uid = ? OR user_email = ?;";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt,"ss", $username, $username);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $uidExists = mysqli_fetch_assoc($resultData);
        if (empty($uidExists)) {
            header("location: ../login.php?error=wronglogin1");
            exit();
        }
        mysqli_stmt_close($stmt);
    }
    //Check if hashed password matches the password input
    $pwdhashed = $uidExists["user_pwd"];
    $checkPwd = password_verify($pwd, $pwdhashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin2");
    }
    elseif ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["user_id"];
        $_SESSION["useruid"] = $uidExists["user_uid"];
        header("location: ../index.php");
        exit();
    }
}