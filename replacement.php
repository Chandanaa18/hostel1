<?php
// Database connection parameters
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add replacement
function addReplacement($name, $date, $conn) {
    $sql = "INSERT INTO replacements (Rname, Rdate) VALUES ('$name', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "Replacement added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $rname = htmlspecialchars($_POST["rname"]);
    $rdate = htmlspecialchars($_POST["rdate"]);

    // Add replacement to the database
    addReplacement($rname, $rdate, $conn);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management - Replacements</title>
</head>
<body>

<h2>Add Replacement</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="rname">Replacement Name:</label>
    <input type="text" name="rname" required>
    <br>
    <label for="rdate">Replacement Date:</label>
    <input type="date" name="rdate" required>
    <br>
    <input type="submit" value="Add Replacement">
</form>

</body>
</html>
