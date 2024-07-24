<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $company = $_POST['company'];
    $contact_number = $_POST['contact_number'];

    // Database connection
    $host = 'localhost';    // Database host
    $user = 'root';         // Database username
    $password = '';         // Database password
    $dbname = 'visitor_management'; // Database name

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert visitor data into database
    $sql = "INSERT INTO visitors (name, company, contact_number) 
            VALUES ('$name', '$company', '$contact_number')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Visitor registered successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
