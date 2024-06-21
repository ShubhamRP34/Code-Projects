

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        .form_container{
            background-color : #a3b7d9;
            border-radius : 5px;
            padding : 10px;
            border : 2px solid #3d79e0;
        }
        .label{font-size : 20px; font-family:Georgia, 'Times New Roman', Times, serif;}
    </style> 
</head>
<body>
<?php
    
    require_once 'connection.php'; // Include the database connection file
    $subject = $_GET['sub'];
    $id = $_GET['id'];

    // echo $subject;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
            
            $description = $_POST["description"];
            $Title = $_POST["Title"];
            
            if(isset($Title) && isset($description))
            {
                
                if(isset($subject))
                {
                 $sql = "CREATE TABLE IF NOT EXISTS educational_video (
                     id INT AUTO_INCREMENT PRIMARY KEY,
                     title VARCHAR(255) NOT NULL,
                     description VARCHAR(255) NOT NULL,
                    subject VARCHAR(255) NOT NULL,
                    video VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

                    )";
            
            if ($conn->query($sql) === TRUE) {
                // echo "Table created successfully";
                $filename = $_FILES["video"]["name"];
                $tempname =  $_FILES["video"]["tmp_name"];
                $folder = "edu_vid/".$filename;
                move_uploaded_file($tempname, $folder);
                
                $stmt = $conn->prepare("INSERT INTO educational_video (title, description, subject, video) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $Title, $description, $subject, $folder);
                
                if($stmt->execute())
                {
                    echo '
                    <div class="message-box" id="messageBox1" style=" background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; text-align: center;">
                    <p style="color: red;">Video '.$Title.' Upload Successfully</p>
                    <a href = "teacher_dashbord.php?id='.$id.'"><button class="ok-button" onclick="messageBox1.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
                    </div>
                    ';
                }
                else
                {
                    echo '
                    <div class="message-box" id="messageBox1" style=" background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; text-align: center;">
                    <p style="color: red;">Something Problem while uploading video<br>Try after some time</p>
                    <button class="ok-button" onclick="messageBox1.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
                    </div>
                    ';
                }

            } else {
                echo "Error creating table: " . $conn->error;
            }

            $conn->close();
            
            }
        }
        }
        ?>
</body>
</html>