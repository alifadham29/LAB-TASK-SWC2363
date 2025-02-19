<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>

<body>

<?php
// Call file to connect server Klinik Ajwa
include ("header.php");

// This section processes submissions from the login form
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Validate the username 
    if(!empty($_POST['ID'])) {
        $un = mysqli_real_escape_string($connect, $_POST['ID']);  
    } else {
        $un = FALSE;
        echo '<p class="error">You forgot to enter your ID.</p>';   
    }
    
    // Validate the password
    if (!empty($_POST['Password'])) {
        $p = mysqli_real_escape_string($connect, $_POST['Password']); 
    } else {
        $p = FALSE;
        echo '<p class="error">You forgot to enter your password.</p>';
    }

    // If no problems
    if ($un && $p) {

        // Retrieve the id, firstname, lastname for the username and password combination
        $q = "SELECT ID, FirstName, LastName, Specialization, Password 
              FROM Doktor WHERE (ID = '$un' AND Password = '$p')";
        
        // Run the query and assign it to the variable $result
        $result = mysqli_query($connect, $q);

        // Count the number of rows that match the username/password combination
        if (mysqli_num_rows($result) == 1) {
            // Start the session, fetch the record and insert the values in an array
            session_start();
            $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);

            echo '<p>Welcome! You are successfully logged in.</p>';

            // Cancel the rest of the script
            exit();

            mysqli_free_result($result);
            mysqli_close($connect);
        } else {
            echo '<p class="error">The username and password entered do not match our records. <br> Perhaps you need to register, just click the Register button.</p>';
        }
    } else {
        echo '<p class="error">Please try again.</p>';
    }
    mysqli_close($connect);
}
?>

<h2 align="center">LOGIN</h2>

<form action="login.php" method="post">
    <p><label class="label" for="ID">ID: </label>
    <input id="ID" type="text" name="ID" size="4" maxlength="6" value="<?php if (isset($_POST['ID'])) echo $_POST['ID']; ?>"></p>
    
    <p><label class="label" for="Password">Password: </label>
    <input id="Password" type="password" name="Password" size="15" maxlength="60" value="<?php if (isset($_POST['Password'])) echo $_POST['Password']; ?>"></p>
    
    <p>&nbsp;</p>
    <p align="left">
        <input id="submit" type="submit" name="submit" value="Login" />
        &nbsp;
        <input id="reset" type="reset" name="reset" value="Reset" />
    </p>
</form>

<p align="center">Don't have an account? <a href="register_doktor.php">Sign up</a></p>

</body>
</html>
