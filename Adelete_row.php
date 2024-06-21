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
     
    //  if ($_SERVER["REQUEST_METHOD"] == "POST") 
    //  {
             
    //      $Table = $_POST["Table"];
    //      $Condition = $_POST["Condition"];

    //      // Query to delete a row based on the condition
    //     $sql = "DELETE FROM $Table WHERE $Condition";

    //     if ($conn->query($sql) === TRUE) {
    //         // echo "Row deleted successfully";
    //         echo '
    //         <div id = "content">
    //         <div id="capture">
    //             <h1>Record deleted in '.$Table.' as per '.$Condition.' condition</h1><br>
    //         </div>
    //         <a href="Administrator.php">
    //         <button>back</button>
    //         </a>
    //         </div>
    //         ';
    //     } 
    //     else 
    //     {
    //         echo '
    //         <div id = "content">
    //         <div id="capture">
    //             <h1>Sorry Record <span style = "color : red; font-style : bold;">Not Deleted</span> in Table '.$Table.' as per condition '.$Condition.'</h1><br>
    //         </div>
    //         <a href="Administrator.php">
    //         <button>back</button>
    //         </a>
    //         </div>
    //         ';
    //     }

    //     // Close connection
    //     $conn->close();
    //  }

    require_once 'connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Table = $_POST["Table"];
    $Condition = $_POST["Condition"];

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM $Table WHERE $Condition";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Row deleted successfully
            echo '
            <div id="content">
                <div id="capture">
                    <h1>Record deleted in ' . $Table . ' as per ' . $Condition . ' condition</h1><br>
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
                <h1>Sorry, an error occurred while deleting records.</h1><br>
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