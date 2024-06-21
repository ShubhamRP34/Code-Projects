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
<body style = "background-color : white">
    <!-- php script to show student data from database -->
    <?php
    require_once 'connection.php'; // Include the database connection file
    // $id = $_GET['id'];

        // if (isset($id)) {
        //     // Email ID is available, and you can use it in your page
        //     // echo "Welcome, " . $email;
        //     // Prepare and execute a query to select the row based on the email
        // $stmt = $conn->prepare("SELECT * FROM student WHERE id = ?");
        // $stmt->bind_param("d", $id);
        // $stmt->execute();
        // $result = $stmt->get_result();
        
        // if ($result->num_rows > 0) {

        //     while ($row = $result->fetch_assoc()) {
                echo '
                <div class="left-side" style="background-color: black; color: white; padding : 25px; border-radius : 15px;">
                <a href = "log in.php"><button id="logout">Log-Out</button></a>
                    <div style="border-radius: 50%; overflow : hidden ;width: 100px; height: 100px;">
                        <img src="admin_image/img1.jpg" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div><br>
                    <div class = "heading">
                        <h2>Welcome, Administrator</h2>
                        <p></p>
                    </div><br><br>
                        <button id="profileBtn" class="active" onclick="changeButtonColor(this)" style = "border-color : white; background-color : white; color : black;">Database</button>
                        <button id="search_table_Btn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Search Table</button>
                        <button id="delete_data_Btn"   onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Delete Data</button>
                        <button id="update_data_Btn"   onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Update Data</button>
                        <button id="insert_data_Btn" onclick="changeButtonColor(this)"   style = "border-color : white; background-color : white">Insert Teacher</button>
                    </div>';
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
            loadContent("Adatabase.php");
        });

        document.getElementById("search_table_Btn").addEventListener("click", function () {
            loadContent("Asearch_table.php");
        });

        document.getElementById("delete_data_Btn").addEventListener("click", function () {
            loadContent("Adelete_data.php");
        });

        document.getElementById("insert_data_Btn").addEventListener("click", function () {
            loadContent("Ainsert_teacher_data.php");
        });

        document.getElementById("update_data_Btn").addEventListener("click", function () {
            loadContent("Aupdate_data.php");
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