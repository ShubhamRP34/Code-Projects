<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
          #content {
    border: 1px solid #ccc;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 5px;
    background-color: #dedede;
    border: 1px solid black;
    }
    #content h1 {
        text-align: center;
        color: #141180;
    }
    #content h2 {text-align: center; color: #141180;}
    #content p {margin-left: 20px; font-size: 20px;}
    #content button {margin-left: 20px; background-color:darkturquoise; border-color:darkturquoise; color : black; padding: 10px; border-radius: 5px;}
</style>
<body>
<?php
require_once 'connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Table = $_POST["Table"];
    $ColumnToUpdate = $_POST["Column_name"];
    $NewValue = $_POST["New_value"];
    $Condition = $_POST["Condition"];

    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE $Table SET $ColumnToUpdate = ? WHERE $Condition";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $NewValue); // Assuming the column is of type 's' (string), adjust accordingly

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Update successful
            echo '
            <div id="content">
                <div id="capture">
                    <h1>Record updated in ' . $Table . ' as per ' . $Condition . ' condition</h1><br>
                </div>
                <a href="Administrator.php">
                    <button>Back</button>
                </a>
            </div>
            ';
        } else {
            // No rows affected, i.e., no matching rows found
            echo '
            <div id="content">
                <div id="capture">
                    <h1>No records found in ' . $Table . ' as per condition ' . $Condition . '</h1><br>
                </div>
                <a href="Administrator.php">
                    <button>Back</button>
                </a>
            </div>
            ';
        }

        $stmt->close();
    } else {
        // Error in the prepared statement
        echo '
        <div id="content">
            <div id="capture">
                <h1>Sorry, an error occurred while updating records.</h1><br>
            </div>
            <a href="Administrator.php">
                <button>Back</button>
            </a>
        </div>
        ';
    }

    // Close connection
    $conn->close();
}
?>

</body>
</html>