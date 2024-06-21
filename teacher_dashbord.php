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
<body onload="loadContent('Tprofile.php')" style = "background-color : white">
    <!-- php script to show student data from database -->
    <?php
    require_once 'connection.php'; // Include the database connection file
    $id = $_GET['id'];

        if (isset($id)) {
            // Email ID is available, and you can use it in your page
            // echo "Welcome, " . $email;
            // Prepare and execute a query to select the row based on the email
        $stmt = $conn->prepare("SELECT * FROM teacher WHERE id = ?");
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                $subject = $row['course'];
                echo '
                <div class="left-side" style="background-color: #010154; color: white; padding : 25px; border-radius : 15px;">
                <a href = "log in.php"><button id="logout">Log-Out</button></a>
                <div style="border-radius: 50%; overflow : hidden ;width: 100px; height: 100px;">
                        <img src="'.$row["image"].'" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                        <div class = "heading">
                        <h2>Welcome, ' . $row["name"] . ' '. $row["surname"] .'</h2>
                        <p>' . $row["email"] .'</p>
                        </div><br><br>
                        <button id="profileBtn" class="active" onclick="changeButtonColor(this)" style = "border-color : white; background-color : white; color : black;">Profile</button>
                        <button id="studentBtn"   onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Students</button>
                        <button id="noticeBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Post Notice</button>
                        <button id="post_noticesBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Posted Notices</button>
                        <button id="uploaded_assignmentBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Uploaded Assignments</button>
                        <button id="uploaded_videoBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Uploaded Video</button>
                        <button id="upload_assignmentBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Upload Assignment</button>
                        <button id="upload_videoBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Upload Video</button>
                        <button id="submissionsBtn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Student Submissions</button>
                    </div>';
            }
        }}
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
            loadContent("Tprofile.php?id=<?php echo $id; ?>");
        });

        document.getElementById("studentBtn").addEventListener("click", function () {
            loadContent("Tstudents.php?sub=<?php echo $subject; ?>");
        });

        document.getElementById("upload_videoBtn").addEventListener("click", function () {
            loadContent("Tupload_video.php?sub=<?php echo $subject; ?>&id=<?php echo $id;?>");
        });

        document.getElementById("upload_assignmentBtn").addEventListener("click", function () {
            loadContent("Tupload_pdf.php?sub=<?php echo $subject; ?>&id=<?php echo $id;?>");
        });

        document.getElementById("uploaded_videoBtn").addEventListener("click", function () {
            loadContent("Tuploaded_video.php?sub=<?php echo $subject; ?>"); 
        });

        document.getElementById("uploaded_assignmentBtn").addEventListener("click", function () {
            loadContent("Tuploaded_assignment.php?sub=<?php echo $subject; ?>"); 
        });

        document.getElementById("noticeBtn").addEventListener("click", function () {
            loadContent("Tupload_notice.php?sub=<?php echo $subject; ?>&id=<?php echo $id;?>"); 
        });

        document.getElementById("post_noticesBtn").addEventListener("click", function () {
            loadContent("Tposted_notice.php?sub=<?php echo $subject; ?>"); 
        });

        document.getElementById("submissionsBtn").addEventListener("click", function () {
            loadContent("Sassignment_answers.php?sub=<?php echo $subject; ?>"); 
        });

        function changeButtonColor(button) {
        var buttons = document.getElementsByTagName("button");
        var logout = document.getElementById("logout");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].style.backgroundColor = "white";
            buttons[i].style.borderColor = "white";
            buttons[i].style.color = "black";
            // buttons[i].style.borderColor = "initial";
            logout.style.backgroundColor = "red";
            logout.style.color = "white";
            logout.style.borderColor = "red";
        }
        button.style.backgroundColor = "#1a23c9";
        button.style.borderColor = "#1a23c9";
        button.style.color = "white";
        }
    </script>
</body>
</html>