<?php
require_once 'connection.php'; // Include the database connection file

session_start();

// Create the student table if it doesn't exist
$createTableSQL = "
CREATE TABLE IF NOT EXISTS student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    adhar VARCHAR(12) NOT NULL,
    birthdate VARCHAR(10) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    phone VARCHAR(10) NOT NULL,
    image VARCHAR(400) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($createTableSQL) === TRUE) {
    // echo "Student table created or already exists.";
//     echo '
// <div class="message-box" id="messageBox1" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
//     <p>Student table created or already exists</p>
//     <button class="ok-button" onclick="messageBox1.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
// </div>
// ';
    

} else {
  
    // echo "Error creating student table: " . $conn->error;
    echo '
    <div class="message-box" id="messageBox2" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
        <p>Error creating student table</p>
        <button class="ok-button" onclick="messageBox2.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
    </div>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $adhar = $_POST["adhar"];
    $birthdate = $_POST["birthdate"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    // $photo = $_FILES["photo"];

// Check if a file was uploaded and there were no errors
// if ($photo["error"] == UPLOAD_ERR_OK) {
    // $tmpName = $photo["tmp_name"];
if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
    // $tmpName = $_FILES["photo"]["tmp_name"];
    // $imageData = file_get_contents($tmpName);
    // $base64Image = base64_encode($imageData);
    // $cleanBase64Image = trim($base64Image);

    $filename = $_FILES["photo"]["name"];
    $tempname =  $_FILES["photo"]["tmp_name"];
    $folder = "images/".$filename;
    move_uploaded_file($tempname, $folder);

    $checkQuery = "SELECT * FROM student WHERE email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows == 0) 
    {
        $stmt = $conn->prepare("INSERT INTO student (name, surname, email, password, adhar, birthdate, gender, phone, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $surname, $email, $password, $adhar, $birthdate, $gender, $phone, $folder);

        if ($stmt->execute()) 
        {
            // echo "Student data has been stored successfully.";
            echo '
            <div class="message-box" id="messageBox3" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
                <p>Student data has been stored successfully</p>
                <button class="ok-button" onclick="closeMessage()" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
            </div>
            <script>
            function closeMessage() {
                document.getElementById("messageBox3").style.display = "none";
                window.location.href = "log in.html"; // Redirect after closing the message
            }
            </script>
            ';
           
            // header("Location: log in.html");
            // exit;
        } 
        else {
            // echo "Error: " . $stmt->error;
            echo '
            <div class="message-box" id="messageBox5" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
                <p>Error while storing data<br>Your data not store</p>
                <button class="ok-button" onclick="messageBox5.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
            </div>
            ';
        }
        $stmt->close();
    } 
    else 
    {
        // echo "Email already exists in the database.";
        echo '
        <div class="message-box" id="messageBox4" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
            <p>Account with email id alreay exist.<br>Your data not saved</p>
            <button class="ok-button" onclick="messageBox4.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
        </div>
        ';
    }
} else {
    // Handle the case where no image was uploaded or there was an error
    $imageData = null; // Set to null if no image is uploaded or if there was an error
    $cleanBase64Image = null;
    echo '
    <div class="message-box" id="messageBox7" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
        <p>Something wrong while exporting image.image not stored<Br>Data not save</p>
        <button class="ok-button" onclick="closeMessage()" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
    </div>
    <script>
    function closeMessage() {
        document.getElementById("messageBox7").style.display = "none";
        window.location.href = "log in.html"; // Redirect after closing the message
    }
    </script>
    ';
}


    // $photo = $_POST["photo"];  //new

    // // Handle image upload
    // if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) 
    // {
    //     $imageData = file_get_contents($photo);
    //     $base64Image = base64_encode($imageData); //new
    //     $cleanBase64Image = trim($base64Image); // new
    // }
    //  else 
    // {
    //     $imageData = null; // Set to null if no image is uploaded
    // }  //new

    // Check if the email already exists in the database
    // $checkQuery = "SELECT * FROM student WHERE email = '$email'";
    // $result = $conn->query($checkQuery);

    // if ($result->num_rows == 0) 
    // {
    //     $stmt = $conn->prepare("INSERT INTO student (name, surname, email, password, adhar, birthdate, phone, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    //     $stmt->bind_param("sssssssb", $name, $surname, $email, $password, $adhar, $birthdate, $phone, $cleanBase64Image);

    //     if ($stmt->execute()) 
    //     {
    //         // echo "Student data has been stored successfully.";
    //         echo '
    //         <div class="message-box" id="messageBox3" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
    //             <p>Student data has been stored successfully</p>
    //             <button class="ok-button" onclick="closeMessage()" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
    //         </div>
    //         <script>
    //         function closeMessage() {
    //             document.getElementById("messageBox3").style.display = "none";
    //             window.location.href = "log in.html"; // Redirect after closing the message
    //         }
    //         </script>
    //         ';
           
    //         // header("Location: log in.html");
    //         // exit;
    //     } 
    //     else {
    //         // echo "Error: " . $stmt->error;
    //         echo '
    //         <div class="message-box" id="messageBox5" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
    //             <p>Error while storing data<br>Your data not store</p>
    //             <button class="ok-button" onclick="messageBox5.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
    //         </div>
    //         ';
    //     }
    //     $stmt->close();
    // } 
    // else 
    // {
    //     // echo "Email already exists in the database.";
    //     echo '
    //     <div class="message-box" id="messageBox4" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
    //         <p>Account with email id alreay exist.<br>Your data not saved</p>
    //         <button class="ok-button" onclick="messageBox4.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
    //     </div>
    //     ';
    // }
}
    
$conn->close();
    ?>
<!DOCTYPE html>
<html>

<head>
    <title>Student Information Form</title>
</head>
<style>
      body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    form {
      text-align: left; /* Optional: Align form fields to the left */
    }

    .content {
      text-align: center;
    }

    label {color: white; font-size: large; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;}
  </style>
<body style="background-image: url('4Dv2mx2-winter-wallpaper.jpg'); background-size: cover; background-repeat: no-repeat;">
    <div>
        <!-- <form action="store_student_data.php" method="post" enctype="multipart/form-data" style="background-color: rgba(0, 0, 0, 0.5); padding : 70px; border-radius: 25px;"> -->
        <form action="student_create_account.php" method="post" enctype="multipart/form-data"  style="background-color: rgba(0, 0, 0, 0.5); padding : 70px; border-radius: 25px;">
            <!-- Name -->
            <h1 style="text-align: center; color: white; font-size: 60px; font-family:Georgia, 'Times New Roman', Times, serif;">Student Information</h1>
            <label for="name" style="margin-right: 180px;">Name</label>
            <input type="text" id="name" name="name" required style="width: 220px;"><br><br>

            <!-- Surname -->
            <label for="surname" style="margin-right: 157px;">Surname</label>
            <input type="text" id="surname" name="surname" required style="width: 220px;"><br><br>

            <!-- Email -->
            <label for="email" style="margin-right: 182px;">Email</label>
            <input type="email" id="email" name="email" required style="width: 220px;"><br><br>

            <label for="password" style="margin-right : 63px;">Password (10 digits):</label>
            <input type="password" id="password" name="password" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{10,}$" style="width: 220px;" title="Password must be at least 10 characters long and include at least one digit, one lowercase letter, one uppercase letter, and one special character (@#$%^&+=)"><br><br>
            <!-- <p id="passwordError" style="color: white;"></p> -->

            <!-- Adhar No -->
            <label for="adhar" style="margin-right: 153px;">Adhar No</label>
            <input type="text" id="adhar" name="adhar" pattern="[0-9]{12}" title="12 digits required" style="width: 220px;"><br><br>

            <!-- Birth Date -->
            <label for="birthdate"style="margin-right: 44px;">Birth Date (dd/mm/yy)</label>
            <input type="date" id="birthdate" name="birthdate" pattern="\d{2}\/\d{2}\/\d{2}"
                title="dd/mm/yy format" style="width: 220px;"><br><br>

            <!-- gnender label -->
                <label for="gender" style="margin-right: 173px;">Gender</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <!-- <option value="other">Other</option> -->
                </select><br><br>

            <!-- Phone No -->
            <label for="phone"style="margin-right: 153px;">Phone No</label>
            <input type="text" id="phone" name="phone" pattern="[0-9]{10}" title="10 digits required" style="width: 220px;" required><br><br>

            <!-- Student Photo -->
            <label for="photo" style="margin-right: 21px;">Student Photo (jpg < 64kb)</label>
                    <input type="file" id="photo" name="photo" accept=".jpg" required><br><br>

            <a href="log in.html"><input type="submit" value="Submit" style="padding: 12px; background-color :cornflowerblue; border-color : cornflowerblue; width: 130px; font-size: 17px; border-radius: 15px;"></a>
        </form>
</div>

</body>

</html>