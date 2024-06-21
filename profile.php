<!DOCTYPE html>
<html>
<head>
<style>
.profile-horizontal {
    display: flex;
    align-items: center;
    background-color: #d9d9db;
    padding: 10px;
    border-radius: 15px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
    transition : 0.5s;
}

.profile-horizontal:hover {
    background-color : #adadad;
    transition : 0.5s;
}

.profile-image {
    margin-right: 20px;
}

.profile-image img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 2px solid #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}

.profile-details {
    color: #333;
}

.profile-details h2 {
    font-size: 24px;
}

.profile-details p {
    font-size: 16px;
    margin: 5px 0;
}


.welcome-greeting {
    background-color: #fca205;
    color: #fff;
    border-radius: 10px;
    padding: 30px;
    max-width: 400px;
    margin: 0 auto;
    margin-top: 100px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
}

.welcome-greeting h1 {
    font-size: 24px;
    color : black;
}

.welcome-greeting p {
    font-size: 16px;
    color : black;
}

       /* Style for the left div */
       .left-div {
            float: left;
            width: 30%; /* Adjust the width as needed */
            background-color: #f0f0f0;
            padding: 10px;
        }

        /* Style for the middle div */
        .middle-div {
            float: left;
            width: 40%; /* Adjust the width as needed */
            background-color: #e0e0e0;
            padding: 10px;
        }

        /* Style for the right div */
        .right-div {
            float: left;
            width: 30%; /* Adjust the width as needed */
            background-color: #d0d0d0;
            padding: 10px;
        }

        /* Clear floats to ensure the layout works properly */
        .clear {
            clear: both;
        }

        /* Style for the "Number of courses" p tag */
        .course-info {
            font-size: 18px;
            color: #007BFF;
        }

        /* widgets */

        .container {
            display: flex;
            justify-content: space-between;
        }
        
        .box {
            background-color: #e6e6ca;
            padding: 10px;
            border-radius: 15px;
            align-items : center;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
            width: 280px;
            border : 1px solid #e6df7e;
            transition : 0.5s;
        }

        .box:hover{
            background-color : #e6df7e;
            transition : 0.5s;
        }
        .box h2{
            text-align : center;
        }
</style>
</head>
<body>
<?php
    require_once 'connection.php'; // Include the database connection file
    
    // if (isset($id))
    if (isset($_GET['id']))
    {
            $id = $_GET['id'];
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
                <br>
                <div class="profile-horizontal">
                <div class="profile-image">
                <img src="'.$row["image"].'" alt="Profile Image" width="150" height="150">
                </div>
                <div class="profile-details">
                    <h2>Name:  ' . $row["name"] . ' '. $row["surname"] .'</h2>
                    <p>Date of Birth: ' . $row["birthdate"] . '</p>
                    <p>Email:' . $row["email"] .'</p>
                    <p>Mobile:' . $row["phone"] .'</p>
                </div>
                </div>
                ';
            }
        }
        $stmt->close();

        $stmt1 = $conn->prepare("SELECT COUNT(*) FROM enrolled_student WHERE stud_id = ?");
        $stmt1->bind_param("d", $id);
        $stmt1->execute();
        $stmt1->bind_result($row_count0);    
        $stmt1->fetch();
        $stmt1->close();
        
        if($row_count0 > 0)
        {
            // wedget 1
            $stmt2 = $conn->prepare("SELECT * FROM enrolled_student WHERE stud_id = ?");
            $stmt2->bind_param("d", $id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            
            while ($row = $result2->fetch_assoc()) {
                echo '      
                <br>
                <div class="container">
                <div class="box">
                <h1 style = "font-size : 25px;">Active Course<br><span style = "color : #061d5e;">'.$row["course_name"].'</span></h2>
                <h1 style = "font-size : 25px;">Applied On<br><span style = "color : #061d5e;">'.$row["created_on"].'</span></h2>
                </div>
                
                ';
        }
        $stmt2->close();

        // widget 2
        
        $stmt_fetch_name = $conn->prepare("SELECT course_name FROM enrolled_student WHERE stud_id = ?");
        $stmt_fetch_name->bind_param("d", $id);
        $stmt_fetch_name->execute();
        // Bind variables to store the result
        $stmt_fetch_name->bind_result($course_name);
        
        // Fetch the result
        $stmt_fetch_name->fetch();
        
        $C_name = $course_name;
        
        $stmt_fetch_name->close();
        
        $stmt3 = $conn->prepare("SELECT COUNT(*)  FROM educational_assignment WHERE subject = ?");
        $stmt3->bind_param("s", $C_name);
        $stmt3->execute();
        $stmt3->bind_result($row_count);    
        $stmt3->fetch();    
        // $result3 = $stmt3->get_result();
        
        // while ($row = $result3->fetch_assoc()) {
            echo '      
            
            
            <div class="box">
            <h2 style = "font-size : 25px;">Total Assignment</h2>
            <h2><span style = "color : #061d5e;">'.$row_count.'</span></h2>
            </div>
            ';
            // }
            $stmt3->close();
            
            $stmt4 = $conn->prepare("SELECT COUNT(*)  FROM educational_student_assignment WHERE stud_id = ? AND subject = ?");
            $stmt4->bind_param("ds", $id, $course_name);
            $stmt4->execute();
            $stmt4->bind_result($row_count_2);    
            $stmt4->fetch();    
            // $result3 = $stmt3->get_result();

        // while ($row = $result3->fetch_assoc()) {
            echo '      
            
            
            <div class="box">
            <h2 style = "font-size : 25px;">Submitted</h2>
            <h2 ><span style = "color : #061d5e;">'.$row_count_2.'</span></h2>
            </div>
            ';
            // }
            $stmt4->close();
            
            $stmt5 = $conn->prepare("SELECT COUNT(*)  FROM educational_video WHERE subject = ?");
            $stmt5->bind_param("s", $C_name);
            $stmt5->execute();
            $stmt5->bind_result($row_count_3);    
            $stmt5->fetch();    
            // $result3 = $stmt3->get_result();
            
            // while ($row = $result3->fetch_assoc()) {
            echo '      
            
            
            <div class="box">
            <h2 style = "font-size : 25px;">Complete Sessions</h2>
            <h2 ><span style = "color : #061d5e;">'.$row_count_3.'</span></h2>
            </div>
            </div>
            ';
            // }
            $stmt5->close();
        }
            
        }
        else
        {
            $quotes = array(
                "Education is the most powerful weapon you can use to change the world. - Nelson Mandela",
                "The roots of education are bitter, but the fruit is sweet. - Aristotle",
                "Education is not the filling of a pail, but the lighting of a fire. - W.B. Yeats",
                "The future belongs to those who believe in the beauty of their dreams. - Eleanor Roosevelt"
            );
            $randomQuote = $quotes[array_rand($quotes)];
            
            echo '
            <div class="welcome-greeting">
            <h1>Welcome</h1>
            <p>' . $randomQuote . '</p>
            <p style = "text-align : center; color : #2436a6; font-size : 19px;" >( Please clck on option for more info )</p>
            </div>';
    }
    
    ?>
<?php
    
    

?>    

</div>
</body>
</html>
