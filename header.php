<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login System</title>
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">   
    </head>
    <body>
        <header>
            <nav>
                <div class="wrapper">
                    <a id=logo><img src="img/logo.png"></a>
                    <ul class="navbar">
                        <li><a href="index.php">Αρχική</a></li>
                        <li><a href="aboutus.php">Σχετικά με Εμάς</a></li>
                        <?php
                            if (isset($_SESSION["useruid"])) {
                                echo "<li><a href='userprofile.php'>To προφίλ μου</a></li>";
                                echo "<li><a href='includes/logout.inc.php'>Αποσύνδεση</a></li>";
                            }
                            else {
                                echo "<li><a href='signup.php'>Εγγραφή</a></li>";
                                echo "<li><a href='login.php'>Σύνδεση</a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>