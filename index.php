<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company Visitor Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Company Visitor Management System</h2>
        
        <!-- Form to register a new visitor -->
        <h3>Register New Visitor</h3>
        <form action="register_visitor.php" method="post">
            <label for="name">Visitor's Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            <label for="company">Company:</label><br>
            <input type="text" id="company" name="company"><br><br>
            <label for="contact_number">Contact Number:</label><br>
            <input type="text" id="contact_number" name="contact_number"><br><br>
            <input type="submit" value="Register Visitor">
        </form>

        <!-- Display list of current visitors -->
        <h3>Current Visitors</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Contact Number</th>
                <th>Entry Time</th>
                <th>Exit Time</th>
            </tr>
            <?php
            // Database connection
            $host = 'localhost';    // Database host
            $user = 'root';         // Database username
            $password = '';         // Database password
            $dbname = 'visitor_management'; // Database name

            $conn = new mysqli($host, $user, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch current visitors data from database (exit_time IS NULL means visitor hasn't exited yet)
            $sql = "SELECT * FROM visitors WHERE exit_time IS NULL";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                    echo "<td>" . $row['entry_time'] . "</td>";
                    echo "<td>---</td>"; // Placeholder for exit time
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No current visitors</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
