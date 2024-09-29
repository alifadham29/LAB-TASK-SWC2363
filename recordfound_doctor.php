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
// Check if ID is set in POST
if (isset($_POST['ID'])) {
    $id = $_POST['ID'];
    
    // Escape the ID to prevent SQL injection
    $id = mysqli_real_escape_string($connect, $id);
    
    // SQL query to fetch doctor details
    $q = "SELECT ID, FirstName, LastName, Specialization, Password FROM doktor WHERE ID = '$id' ORDER BY ID";
    
    $result = @mysqli_query($connect, $q); // Execute query

    // Check if query was successful
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Table headers for displaying the results
            echo '<table border="2">
            <tr>
                <td><b>ID</b></td>
                <td><b>First Name</b></td>
                <td><b>Last Name</b></td>
                <td><b>Specialization</b></td>
                <td><b>Password</b></td>
            </tr>';
            
            // Fetch and display records
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>
                    <td>' . $row['ID'] . '</td>
                    <td>' . $row['FirstName'] . '</td>
                    <td>' . $row['LastName'] . '</td>
                    <td>' . $row['Specialization'] . '</td>
                    <td>' . $row['Password'] . '</td>
                </tr>';
            }

            echo '</table>'; // Close the table
            mysqli_free_result($result); // Free result set
        } else {
            // No records found
            echo '<p class="error">No records found for the provided ID.</p>';
        }
    } else {
        // Query error
        echo '<p class="error">The query failed. Please check the input and try again.</p>';
        echo '<p>' . mysqli_error($connect) . '<br>Query: ' . $q . '</p>'; // Debugging info
    }
} else {
    echo '<p class="error">No ID provided. Please go back and enter a valid ID.</p>';
}

mysqli_close($connect); // Close the database connection
?>

</body>
</html>
