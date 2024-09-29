<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
// call file to connect to server
include("header.php");

// This query inserts a record in the doktor table if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array(); // initialize an error array

    // Check for a Firstname
    if (empty($_POST['FirstName'])) {
        $error[] = 'You forgot to enter your First Name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName']));
    }

    // Check for a LastName
    if (empty($_POST['LastName'])) {
        $error[] = 'You forgot to enter your Last Name.';
    } else {
        $l = mysqli_real_escape_string($connect, trim($_POST['LastName']));
    }

    // Check for a Specialization
    if (empty($_POST['Specialization'])) {
        $error[] = 'You forgot to enter your Specialization.';
    } else {
        $s = mysqli_real_escape_string($connect, trim($_POST['Specialization']));
    }

    // Check for a Password
    if (empty($_POST['Password'])) {
        $error[] = 'You forgot to enter your Password.';
    } else {
        $p = mysqli_real_escape_string($connect, trim($_POST['Password']));
    }

    // If no errors, register the user in the database
    if (empty($error)) {
        // Make the query
        $q = "INSERT INTO doktor (ID, FirstName, LastName, Specialization, Password) 
              VALUES ('', '$n', '$l', '$s', '$p')";
        $result = @mysqli_query($connect, $q); // run the query
        
        if ($result) { // If it runs
            echo '<h1>Thank you, registration successful!</h1>';
        } else { // If it did not run
            // Message
            echo '<h1>System error</h1>';
            // Debugging message
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
        mysqli_close($connect); // Close the database connection
        exit();
    } else {
        // Display the errors
        foreach ($error as $msg) {
            echo "<p class='error'>$msg</p>";
        }
    }
}
?>

<h2>Register Doctor</h2>
<h4>* required field</h4>
<form action="registerDoktor.php" method="post">

    <p><label class="label" for="FirstName">First Name: *</label>
    <input id="FirstName" type="text" name="FirstName" size="30" maxlength="150" 
           value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName']; ?>" /></p>

    <p><label class="label" for="LastName">Last Name: *</label>
    <input id="LastName" type="text" name="LastName" size="30" maxlength="60" 
           value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName']; ?>" /></p>

    <p><label class="label" for="Specialization">Specialization: *</label>
    <input id="Specialization" type="text" name="Specialization" size="12" maxlength="12" 
           value="<?php if (isset($_POST['Specialization'])) echo $_POST['Specialization']; ?>" /></p>

    <p><label class="label" for="Password">Password: *</label>
    <input id="Password" type="password" name="Password" size="12" maxlength="12" 
           value="<?php if (isset($_POST['Password'])) echo $_POST['Password']; ?>" /></p>

    <p><input id="submit" type="submit" name="submit" value="Register" /> &nbsp;&nbsp;
       <input id="reset" type="reset" name="reset" value="Clear All" /></p>
</form>

<br />
<br />
<br />  

</body>
</html>
