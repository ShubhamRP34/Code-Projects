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

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $course = $_POST["course"];
    $teacher_id = $_POST["teacher_id"];
    $adhar = $_POST["adhar"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    // $photo = $_FILES["photo"];

if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {

    $filename = $_FILES["photo"]["name"];
    $tempname =  $_FILES["photo"]["tmp_name"];
    $folder = "timage/".$filename;
    move_uploaded_file($tempname, $folder);

    $checkQuery = "SELECT * FROM student WHERE email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows == 0) 
    {
        $stmt = $conn->prepare("INSERT INTO teacher (name, surname, email, course, teacher_id, adhar, gender, phone, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $surname, $email, $course, $teacher_id, $adhar, $gender, $phone, $folder);

        if ($stmt->execute()) 
        {
            // echo "Student data has been stored successfully.";

            echo '
            <div id="content">
                <div id="capture">
                    <h1>Teacher data has been stored successfully</h1><br>
                </div>
                <a href="Administrator.php">
                    <button>Back</button>
                </a>
            </div>
            ';
           
            // header("Location: log in.html");
            // exit;
        } 
        else {
            // echo "Error: " . $stmt->error;

            echo '
            <div id="content">
                <div id="capture">
                    <h1><span style = "color : red;">Error while storing data <br>Your data not store</span></h1><br>
                </div>
                <a href="Administrator.php">
                    <button>Back</button>
                </a>
            </div>
            ';
        }
        $stmt->close();
    } 
    else 
    {
        // echo "Email already exists in the database.";

        echo '
        <div id="content">
            <div id="capture">
                <h1><span style = "color : red;">Account with email id already exist.<br>Your dat not saved<span></h1><br>
            </div>
            <a href="Administrator.php">
                <button>Back</button>
            </a>
        </div>
        ';
    }
} else {
    // Handle the case where no image was uploaded or there was an error
    $imageData = null; // Set to null if no image is uploaded or if there was an error
    $cleanBase64Image = null;

    echo '
    <div id="content">
        <div id="capture">
            <h1><span style = "color : red;">Something wrong while exporting image.<br>Image not stored & your data not saved</span></h1><br>
        </div>
        <a href="Administrator.php">
            <button>Back</button>
        </a>
    </div>
    ';
}
}
    
$conn->close();
?>
</body>
</html>