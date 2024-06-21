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
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
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
        $stmt = $conn->prepare("SELECT * FROM teacher WHERE id = ?");
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
                    <p>Email:' . $row["email"] .'</p>
                    <p>Mobile:' . $row["phone"] .'</p>
                    <p>Subject: ' . $row["course"] . '</p>
                </div>
                </div>
';
            }
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
        <h1 style = "text-align : center">Select option for more info</h1>
    </div>';

    }

    ?>
<?php
    // $quotes = array(
    //         "Education is the most powerful weapon you can use to change the world. - Nelson Mandela",
    //         "The roots of education are bitter, but the fruit is sweet. - Aristotle",
    //         "Education is not the filling of a pail, but the lighting of a fire. - W.B. Yeats",
    //         "The future belongs to those who believe in the beauty of their dreams. - Eleanor Roosevelt"
    //     );
    //     $randomQuote = $quotes[array_rand($quotes)];
    

?>    

</div>
</body>
</html>
