<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Search Result</title>
</head>
<body>
<?php include("header.php"); ?>
<h2>Search Result</h2>

<?php
// Check if Insurance_Number is passed through POST
if (isset($_POST['Insurance_Number'])) {
    // Escape user input to prevent SQL injection
    $in = mysqli_real_escape_string($connect, $_POST['Insurance_Number']);
    
    // Query to fetch patient details
    $q = "SELECT ID_P, FirstName_P, LastName_P, Insurance_Number, Diagnose 
          FROM pesakit 
          WHERE Insurance_Number = '$in' 
          ORDER BY ID_P";
    
    $result = @mysqli_query($connect, $q); // Execute query

    // Check if query succeeded
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Display table headers if results are found
            echo '<table border="2"> 
            <tr>
                <td><b>ID</b></td>
                <td><b>First Name</b></td>
                <td><b>Last Name</b></td>
                <td><b>Insurance Number</b></td>
                <td><b>Diagnose</b></td>
            </tr>';
            
            // Fetch and display records
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>
                    <td>' . $row['ID_P'] . '</td>
                    <td>' . $row['FirstName_P'] . '</td>
                    <td>' . $row['LastName_P'] . '</td>
                    <td>' . $row['Insurance_Number'] . '</td>
                    <td>' . $row['Diagnose'] . '</td>
                </tr>';
            }

            echo '</table>'; // Close table
            mysqli_free_result($result); // Free result set
        } else {
            // No results found
            echo '<p class="error">No records found for the provided Insurance Number.</p>';
        }
    } else {
        // Display query error
        echo '<p class="error">There was a problem with the query.</p>';
        echo '<p>' . mysqli_error($connect) . '<br>Query: ' . $q . '</p>';
    }
} else {
    echo '<p class="error">Insurance Number was not provided. Please try again.</p>';
}

mysqli_close($connect); // Close database connection
?>

</body>
</html>
