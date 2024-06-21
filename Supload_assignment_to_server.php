

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
            
            // $description = $_POST["description"];
            $Title = $_POST["Title"];
            // $ldate = $_POST["ldate"];
            
            if(isset($Title))
            {

                $stmt_fetch_name = $conn->prepare("SELECT stud_name, stud_surname FROM enrolled_student WHERE stud_id = ?");
                $stmt_fetch_name->bind_param("d", $id);
                $stmt_fetch_name->execute();
                // Bind variables to store the result
                $stmt_fetch_name->bind_result($stud_name, $stud_surname);

                // Fetch the result
                $stmt_fetch_name->fetch();

                $name = $stud_name . " " . $stud_surname;

                $stmt_fetch_name->close();
                
                if(isset($subject))
                {
                 $sql = "CREATE TABLE IF NOT EXISTS educational_student_assignment (
                     id INT AUTO_INCREMENT PRIMARY KEY,
                     stud_id INT NOT NULL,
                     name VARCHAR(255) NOT NULL,
                     title VARCHAR(255) NOT NULL,
                     subject VARCHAR(255) NOT NULL,
                     pdf VARCHAR(255) NOT NULL,
                     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
            
            if ($conn->query($sql) === TRUE) {
                // echo "Table created successfully";
                $filename = $_FILES["pdf"]["name"];
                $tempname =  $_FILES["pdf"]["tmp_name"];
                $folder = "student_assignment/".$filename;
                move_uploaded_file($tempname, $folder);
                
                $stmt = $conn->prepare("INSERT INTO educational_student_assignment (stud_id, name, title, subject, pdf) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("dssss", $id, $name, $Title, $subject, $folder);
                
                if($stmt->execute())
                {
                    echo '
                    <div class="message-box" id="messageBox1" style=" background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; text-align: center;">
                    <p style="color: blue;">Assignment '.$Title.' Upload Successfully</p>
                    <a href = "student_dashbord.php?id='.$id.'"><button class="ok-button" onclick="messageBox1.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
                    </div>
                    ';
                }
                else
                {
                    echo '
                    <div class="message-box" id="messageBox1" style=" background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; text-align: center;">
                    <p style="color: red;">Something Problem while uploading Assignment<br>Try after some time</p>
                    <button class="ok-button" onclick="messageBox1.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
                    </div>
                    ';
                }

            } else {
                // echo "Error creating table: " . $conn->error;
                echo '
                <br>
                <div class = "recipt">
                <h3>No Data Found !!!</h3>
                </div>
                ';
            }

            $conn->close();
            
            }
        }
        }
        ?>
</body>
</html>