<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        table {
            border-collapse: collapse;
            width: 99%;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #d3dae6;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
</style>
<body>
    <?php
        require_once 'connection.php';
        // Query to get all tables in the 'olp' database
        $sql = "SHOW TABLES";
        $result = $conn->query($sql);

        // Check if there are tables
        if ($result->num_rows > 0) {
            echo '<br>';
            echo "<table border='1'><tr><th>Tables in olp database</th></tr>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Tables_in_olp"] . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "No tables found in the olp database";
        }

        // Close connection
        $conn->close();
    ?>
</body>
</html>