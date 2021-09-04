<?php
    include_once 'header.php';
?>
        <section class= "signup">
            <h1>Κάνε Εγγραφή Τώρα!</h1>
            <form action="includes/signup.inc.php" method="post" class='login-form'>
                <?php
                echo "<p>Όνομα</p>";
                if (isset($_GET['firstName'])) {
                    $first = $_GET['firstName'];
                    echo "<input type='text' name ='firstName' placeholder ='First Name..' value ='$first'>";
                }
                else {
                   echo "<input type='text' name ='firstName' placeholder ='First Name..'>";
                }
                echo "<p>Επώνυμο</p>";
                if (isset($_GET['lastName'])) {
                    $last = $_GET['lastName'];
                    echo "<input type='text' name ='lastName' placeholder ='Last Name..' value ='$last'>";
                }
                else {
                   echo "<input type='text' name ='lastName' placeholder ='Last Name..'>";
                }
                echo "<p>Όνομα Χρήστη</p>";
                if (isset($_GET['userid'])) {
                    $username = $_GET['userid'];
                    echo "<input type='text' name ='userid' placeholder ='Username..' value ='$username'>";
                }
                else {
                   echo "<input type='text' name ='userid' placeholder ='Username..'>";
                }
                echo "<p>E-mail</p>";
                if (isset($_GET['email'])) {
                    $email = $_GET['email'];
                    echo "<input type='text' name ='email' placeholder ='E-mail..' value ='$email'>";
                }
                else {
                   echo "<input type='text' name ='email' placeholder ='E-mail..'>";
                }
                ?>
                <p>Κωδικός Πρόσβασης</p>
                <input type='password' name='pwd' placeholder='Password..'>
                <p>Επανάληψη Κωδικού Πρόσβασης</p>
                <input type='password' name='pwdrepeat' placeholder='Repeat Password..'><br>
                <button type='submit' name='submit' value='submit'>Εγγραφή</button>
            </form>
            <?php
            //Error Messages on signup form
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyinput") {
                    echo "<p class='error-message'>Συμπλήρωστε όλα τα κενά!</p>";
                }
                elseif ($_GET['error'] == "invaliduid") {
                    echo "<p class='error-message'>Μή επιτρεπτό όνομα χρήστη!</p>";
                }
                elseif ($_GET['error'] == "invalidemail") {
                    echo "<p class='error-message'>Εισάγετε ενα σωστό E-mail!</p>";
                }
                elseif ($_GET['error'] == "pwddiffering") {
                    echo "<p class='error-message'>Οι κωδικοί δεν ταιριάζουν!</p>";
                }
                elseif ($_GET['error'] == "usernametaken") {
                    echo "<p class='error-message'>To όνομα χρήστη υπάρχει ήδη!</p>";
                }
                elseif ($_GET['error'] == "emailtaken") {
                    echo "<p class='error-message'>Η διεύθυνση Email υπάρχει ήδη!</p>";
                }
                elseif ($_GET['error'] == "none") {
                    echo "<p class='error-none'>Επιτυχής Εγγραφή!</p>";
                }
            }

        ?>
        </section>
    </div>
    <footer>
    </footer>
    </body>
</html>