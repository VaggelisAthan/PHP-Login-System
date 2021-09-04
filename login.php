<?php
    include_once 'header.php';
?>
        <section class= "login">
            <h1>Σύνδεσου στο λογαργιασμό σου!</h1>
                <form action="includes/login.inc.php" method="post" class='login-form'>
                    <p>Όνομα Χρήστη</p>
                    <?php
                        if (isset($_GET['userid'])) {
                            $username = $_GET['userid'];
                            echo "<input type='text' name='userid' placeholder='Username/E-mail..' value = '$username'>";
                        }
                        else {
                            echo "<input type='text' name='userid' placeholder='Username/E-mail..'>";
                        }
                    ?>
                    <p>Κωδικός Πρόσβασης</p>
                    <input type='password' name='pwd' placeholder='Password..'>
                    <button type='submit' name='submit' value='submit'>Σύνδεση</button>
                </form>
                <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyinput") {
                            echo "<p class='error-message'>Συμπλήρωστε όλα τα κενά!</p>";
                        }
                        elseif ($_GET['error'] == "wronglogin") {
                            echo "<p class='error-message'>Λάθος όνομα χρήστη ή κωδικός πρόσβασης!</p>";
                        }
                    }
                ?>
        </section>
    </div>
    <footer>
    </footer>
    </body>
</html>