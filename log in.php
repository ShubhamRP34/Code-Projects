<?php

// require_once 'connection.php'; // Include the database connection file


// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//      // Get user input from the form
//      $email = $_POST["email"];
//      $password = $_POST["password"];

    // // Prepare and execute a query to check the email and password
    // $stmt = $conn->prepare("SELECT id, email, password FROM student WHERE email = ?");
    // $stmt->bind_param("s", $email);
    // $stmt->execute();
    // $stmt->store_result();
    // $stmt->bind_result($id, $dbEmail, $dbPassword);
    // $stmt->fetch();

    // // Verify if the email exists and the password matches
    // // if ($stmt->num_rows == 1 && password_verify($password, $dbPassword))
    // if ($stmt->num_rows == 1 && $password === $dbPassword)
    // {
    //     // Authentication successful
    //     $_SESSION["user_id"] = $id;
    //     header("Location: student_dashboard.html");
    //     exit();
    // } else {
    //     // Authentication failed, show an error message
    //     // $error = "Invalid email or password. Please try again.";
    //     echo '
    //         <div class="message-box" id="messageBox1" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
    //             <p style = "color : red;">Invalid email or password. Please try again.</p>
    //             <button class="ok-button" onclick="messageBox1.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
    //         </div>
    //         ';
    // }

    // Close the database connection
    // $stmt->close();
// }
?> 

<?php

require_once 'connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the login request is for a student
    if (isset($_POST["student_login"])) {
        // Prepare and execute a query to check the email and password in the student table
        $stmt = $conn->prepare("SELECT id, email, password FROM student WHERE email = ?");
        $stmt->bind_param("s", $email);
    } elseif (isset($_POST["teacher_login"])) {
        // Prepare and execute a query to check the email and password in the teacher table
        $stmt = $conn->prepare("SELECT id, email, teacher_id FROM teacher WHERE email = ?");
        $stmt->bind_param("s", $email);
    } else {
        // Handle the case where the login type is not specified
        // echo "Login type not specified.";
        echo '
        <div class="message-box" id="messageBox1" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
        <p style="color: red;">Login type not specified.</p>
        <button class="ok-button" onclick="messageBox1.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
        </div>
        ';
        exit();
    }
    
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $dbEmail, $dbPassword);
    $stmt->fetch();
    echo $dbPassword;


    // Verify if the email exists and the password matches
    if ($stmt->num_rows == 1 && $password === $dbPassword) {

        // Authentication successful
        if (isset($_POST["student_login"]))
        {
            $_SESSION["user_id"] = $id;
            header("Location: student_dashbord.php?id=" . urlencode($id));
            exit();
        }
        elseif (isset($_POST["teacher_login"]))
        {
            $_SESSION["user_id"] = $id;
            header("Location: teacher_dashbord.php?id=" . urlencode($id));
            exit();
        }
    } else {
        // Authentication failed, show an error message
        echo '
            <div class="message-box" id="messageBox2" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
                <p style="color: red;">Invalid email or password. Please try again.</p>
                <button class="ok-button" onclick="messageBox2.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
            </div>
        ';
    }

    // Close the database connection
    $stmt->close();
}
?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .login-container {
            background-color: #fff;
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2674c2;
        }
    </style>
</head>
<body style="background-image: url('4Dv2mx2-winter-wallpaper.jpg'); background-size: cover; background-repeat: no-repeat;">
    <div>
        <button id="toggleButton" onclick="toggleSections()" style="background-color:#3498db; width: 180px; float: right; margin-top: -140px; color : white;">Show | Teacher Login</button>
        <div class="login-container"  id="studentSection" style="margin-top : 150px; background-color: rgba(0, 0, 0, 0.3);">
        <h1 style="color: white;">Login</h1>
        <form action="log in.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="student_login" value="student_login">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p style="text-align:center; color: white;">OR</p>
        </form>
        <a href="student_create_account.php"><button>Create Account</button></a><br><br>
        <a href="index.html"><button style="background-color:royalblue;">Back</button></a>
    </div>

    <div class="login-container" id="teacherSection" style="display: none; margin-top : 150px; background-color: rgba(0, 0, 0, 0.3);">
        <h1 style="color: white;">Login</h1>
        <form action="log in.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="teacher_login" value="teacher_login">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Teachers ID" required>
            <button type="submit">Login</button>
            <p style="text-align:center; color: white;">OR</p>
        </form>
        <!-- <a href="student_create_account.php"><button>Create Account</button></a><br><br> -->
        <a href="index.html"><button style="background-color:royalblue;">Back</button></a>
    </div>
</div>
    
    <script>
        function toggleSections() {
            var toggleButton = document.getElementById("toggleButton");
            var studentSection = document.getElementById("studentSection");
            var teacherSection = document.getElementById("teacherSection");

            if (studentSection.style.display === "none") {
                studentSection.style.display = "block";
                teacherSection.style.display = "none";
                toggleButton.textContent = "Show | Teacher Login";
            } else {
                studentSection.style.display = "none";
                teacherSection.style.display = "block";
                toggleButton.textContent = "Show | Student Login";
            }
        }
    </script>
</body>
</html>

