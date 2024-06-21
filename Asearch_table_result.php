<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
     require_once 'connection.php'; // Include the database connection file
    //  $subject = $_GET['sub'];
    //  $id = $_GET['id'];
 
     // echo $subject;
     
     if ($_SERVER["REQUEST_METHOD"] == "POST") 
     {
             
             // $description = $_POST["description"];
             $Table = $_POST["Table"];
            //  echo $Table;
             // $ldate = $_POST["ldate"];

             // Query to get all data from the specified table
$sql = "SELECT * FROM $Table";
$result = $conn->query($sql);

// Check if there is data
if ($result->num_rows > 0) {
    echo '<a href="Administrator.php"><button style = "padding : 7px; width : 100px; border-radius : 7px; background-color : #5069d9; border-color : #5069d9; color : white;">back</button></a>';
    echo "<br><br><table border='1'><tr>";

    // Output column headers
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $column => $value) {
            echo "<th>$column</th>";
        }
        break; // Break after fetching the first row to output column headers
    }

    echo "</tr>";

    // Output data of each row
    $result->data_seek(0); // Reset the result set pointer to the beginning
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Table not found";
}

// Close connection
$conn->close();
     }
    ?>
</body>
</html>