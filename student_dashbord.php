<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .heading {
            color : white; margin-left : 120px; margin-top : -100px;
        }

        #logout{
            background-color : red;
            color : white;
            margin-left : 92%;
            /* margin-top : ; */
            padding : 5px;
            width : 100px;
            border-color : red;

        }
    </style>
</head>
<!-- Add an onload event handler to your body tag -->
<body onload="loadContent('profile.php')" style = "background-color : white">
    <!-- php script to show student data from database -->
    <?php
    require_once 'connection.php'; // Include the database connection file
    $id = $_GET['id'];

        if (isset($id)) {
            // Email ID is available, and you can use it in your page
            // echo "Welcome, " . $email;
            // Prepare and execute a query to select the row based on the email
        $stmt = $conn->prepare("SELECT * FROM student WHERE id = ?");
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="left-side" style="background-color: black; color: white; padding : 25px; border-radius : 15px;">
                <a href = "log in.php"><button id="logout">Log-Out</button></a>
                    <div style="border-radius: 50%; overflow : hidden ;width: 100px; height: 100px;">
                        <img src="'.$row["image"].'" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class = "heading">
                        <h2>Welcome, ' . $row["name"] . ' '. $row["surname"] .'</h2>
                        <p>' . $row["email"] .'</p>
                    </div><br><br>
                        <button id="profileBtn" class="active" onclick="changeButtonColor(this)" style = "border-color : white; background-color : white; color : black;">Dashbord</button>
                        <button id="coursesBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Courses</button>
                        <button id="classroomBtn"   onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">video</button>
                        <button id="applicationBtn1" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Assignment</button>
                        <button id="applicationBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Upload Assignment</button>
                        <button id="noticeBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Notice</button>
                        <button id="transactionBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Transaction</button>
                    </div>';
            }
        }
        $stmt->close();

        // // SQL query to select course_name from the enrolled_student table
        // $sql = "SELECT course_name FROM enrolled_student WHERE stud_id = $id";

        // // // Execute the query
        // $result = $conn->query($sql);
        // $row = $result->fetch_assoc();
        // $courseName = $row['course_name'];
        // $conn->close();

        $stmt3 = $conn->prepare("SELECT course_name FROM enrolled_student WHERE stud_id = ?");
        $stmt3->bind_param("d", $id);
        $stmt3->execute();
        $stmt3->bind_result($courseName);    
        $stmt3->fetch(); 
        $stmt3->close();
      

    }
        // }
        ?>

    <div class="right-side" id="content">
        <!-- Content will be loaded here -->
    </div>

    <script>
        // Function to load content into the right side
        function loadContent(page) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", page, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("content").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Button click event handlers to load content
        document.getElementById("profileBtn").addEventListener("click", function () {
            loadContent("profile.php?id=<?php echo $id; ?>");
        });

        document.getElementById("coursesBtn").addEventListener("click", function () {
            loadContent("courses.php?id=<?php echo $id; ?>");
        });

        // document.getElementById("applicationBtn").addEventListener("click", function () {
        //     loadContent("assignment.php");
        // });

        // document.getElementById("classroomBtn").addEventListener("click", function () {
        //     loadContent("classroom.php");
        // });

        document.getElementById("transactionBtn").addEventListener("click", function () {
            loadContent("transaction.php?id=<?php echo $id; ?>");
        });

        document.getElementById("noticeBtn").addEventListener("click", function () {
            loadContent("Tposted_notice.php?sub=<?php echo $courseName; ?>");
        });

        document.getElementById("classroomBtn").addEventListener("click", function () {
            loadContent("Tuploaded_video.php?sub=<?php echo $courseName; ?>");
        });

        document.getElementById("applicationBtn1").addEventListener("click", function () {
            loadContent("Tuploaded_assignment.php?sub=<?php echo $courseName; ?>");
        });

        document.getElementById("applicationBtn").addEventListener("click", function () {
            loadContent("Supload_assignment.php?sub=<?php echo $courseName; ?>&id=<?php echo $id;?>");
        });


        function changeButtonColor(button) {
        var buttons = document.getElementsByTagName("button");
        var logout = document.getElementById("logout");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].style.backgroundColor = "white";
            buttons[i].style.borderColor = "white";
            buttons[i].style.color = "black";
            logout.style.backgroundColor = "red";
            logout.style.color = "white";
            logout.style.borderColor = "red";
            // buttons[i].style.borderColor = "initial";
        }
        button.style.backgroundColor = "#1a23c9";
        button.style.borderColor = "#1a23c9";
        button.style.color = "white";

        }
    </script>
</body>
</html>