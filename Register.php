<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<?php
// Call file to connect to server
include ("header.php");

// This query inserts a record in the clinic table
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $errors = array(); // Initialize an error array
    
    // Check for a First Name
    if (empty($_POST['FirstName_P'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName_P']));
    }
    
    // Check for a Last Name
    if (empty($_POST['LastName_P'])) {
        $errors[] = 'You forgot to enter your last name.';
    } else {
        $ln = mysqli_real_escape_string($connect, trim($_POST['LastName_P']));
    }
    
    // Check for an Insurance Number
    if (empty($_POST['Insurance_Number'])) {
        $errors[] = 'You forgot to enter your Insurance Number.';
    } else {
        $i = mysqli_real_escape_string($connect, trim($_POST['Insurance_Number']));
    }
    
    // Check for a Diagnose
    if (empty($_POST['Diagnose'])) {
        $errors[] = 'You forgot to enter your diagnose.';
    } else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
    }

    // If no errors, register the user in the database
    if (empty($errors)) {
        // Make the query:
        $q = "INSERT INTO pesakit (ID_P, FirstName_P, LastName_P, Insurance_Number, Diagnose)
              VALUES ('', '$n', '$ln', '$i', '$d')";
        
        $result = @mysqli_query($connect, $q); // Run the query
        
        if ($result) { // If it runs
            echo '<h1>Thank you</h1>';
            exit();
        } else { // If it did not run
            // System error message
            echo '<h1>System error</h1>';
            // Debugging message
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
        
        mysqli_close($connect); // Close the database connection
        exit();
    } else {
        // Display error messages
        foreach ($errors as $msg) {
            echo "<p class='error'>$msg</p>";
        }
    }
} // End of the main submit conditional
?>

<h2>Register</h2>
<h4>* required field</h4>

<form action="register.php" method="post">
    <p>
        <label class="label" for="FirstName_P">First Name: *</label>
        <input id="FirstName_P" type="text" name="FirstName_P" size="30" maxlength="150" 
               value="<?php if (isset($_POST['FirstName_P'])) echo $_POST['FirstName_P']; ?>" />
    </p>

    <p>
        <label class="label" for="LastName_P">Last Name: *</label>
        <input id="LastName_P" type="text" name="LastName_P" size="30" maxlength="60" 
               value="<?php if (isset($_POST['LastName_P'])) echo $_POST['LastName_P']; ?>" />
    </p>

    <p>
        <label class="label" for="Insurance_Number">Insurance Number: *</label>
        <input id="Insurance_Number" type="text" name="Insurance_Number" size="12" maxlength="12" 
               value="<?php if (isset($_POST['Insurance_Number'])) echo $_POST['Insurance_Number']; ?>" />
    </p>

    <p>
        <label class="label" for="Diagnose">Diagnose: *</label>
        <textarea name="Diagnose" rows="5" cols="40"><?php if (isset($_POST['Diagnose'])) echo $_POST['Diagnose']; ?></textarea>
    </p>

    <p>
        <input id="submit" type="submit" name="submit" value="Register" /> &nbsp;&nbsp;
        <input id="reset" type="reset" name="reset" value="Clear All" />
    </p>
</form>

</body>
</html>
