<?php


// if (isset($_POST['redirect_button'])) {
//     // Call the function when the button is clicked
//     redirectToNewPage();
// }
// else
// {
//     echo 'This button no click';
// }

// // Define a PHP function for redirection
// function redirectToNewPage() {
//     require_once 'connection.php'; // Include the database connection file

    
//         // Define the SELECT query
//         // $sql = "SELECT id, name, surname, email, phone FROM student WERE ";
//         $stmt = $conn->prepare("SELECT name, surname, email, phone FROM student WHERE id = ?");
//         $stmt->bind_param("d", $id);
//         $stmt->execute();
//         $stmt->bind_result($name, $surname, $email, $phone);
//         $stmt->fetch();

//         echo $name;

//         // Insert data into enrolled_student table
//         $stmt1 = $conn->prepare("INSERT INTO fee_records (stud_id, stud_name, stud_surname, course_name, price) VALUES (?, ?, ?, ?, ?)");
//         $stmt1->bind_param("dssss",$id, $name, $surname, $c_name, $price);

//         // Insert data into fee_records table
//         $stmt2 = $conn->prepare("INSERT INTO enrolled_student (stud_id, stud_name, stud_surname, email, phone_no, course_name) VALUES (?, ?, ?, ?, ?, ?)");
//         $stmt2->bind_param("dsssss", $id, $name, $surname, $email, $phone, $c_name);

//         // Execute the first query
//         if ($stmt1->execute() && $stmt2->execute()) {
//             // Commit the transaction if both queries were successful
//             $conn->commit();
//             echo "Data inserted into both tables successfully.";
//         } else {
//             // Rollback the transaction if any query fails
//             $conn->rollback();
//             echo "Error: " . $conn->error;
//         }

//         $conn->close();


//     header("Location: recipt.php?id=". urlencode($id));
//     exit(); // Make sure to exit to prevent further script execution
// }  

?>



<!DOCTYPE html>
<html>
<head>
    <style>
        /* .payment-box {
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
        } */

        .message-box {
            /* display: none; */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color:#2567f5;
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 400px;
            text-align: center;
            border-radius : 10px;
            box-shadow: 5px 5px 10px 0px rgba(0, 0, 0, 0.5);
        }

        .inner{
            padding : 50px;
        }

        .message-box h1 {
            text-align: center;
            color: white;
            font-size : 60px;
        }
        
        .message-box p {
            font-size : 30px;
        }

        .ok-button {
            background-color: #053db5;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100px;
            border-radius : 5px;
        }

    </style>
</head>
<body>
    <!-- <button id="show-payment">Show Payment</button> -->
    
    <!-- <div class="payment-box" id="payment-box">
        <h2>Payment Details</h2>
        <p>Price: $100</p>
        <button id="pay-button">Pay</button>
        <button id="back-button">Back</button>
    </div> -->

    <?php

    require_once 'connection.php'; // Include the database connection file

    $price = $_GET['int'];
    $id = $_GET['id'];
    $c_name = $_GET['c_name'];

    // echo "Value of param1: " . $price . "<br>";
    // echo "Value of param2: " . $id . "<br>";

    if (isset($price)) {
        if(isset($c_name))
        {

            if(isset($id))
            {
                
                echo '
                <div class="message-box">
                <div class = "inner">
                <h1>Pay</h1>
                <p>'.$price.'</p>
                
                <a href="recipt.php?int='.$price.'&id='.$id.'&c_name='.$c_name.'">
                <button class="ok-button" type="submit" name="redirect_button">Confirm</button>
                </a>
                <br><br>
                <a href="student_dashbord.php?id='.$id.'">
                <button class="ok-button">back</button><br>
                </a>
                </div>
                </div>
                
                ';
            }
        }
        }


        // if (isset($_POST['redirect_button'])) {
        //     // Call the function when the button is clicked
        //     redirectToNewPage();
        // }

        // // Define a PHP function for redirection
        // function redirectToNewPage() {

            
        //         // Define the SELECT query
        //         // $sql = "SELECT id, name, surname, email, phone FROM student WERE ";
        //         $stmt = $conn->prepare("SELECT name, surname, email, phone FROM student WHERE id = ?");
        //         $stmt->bind_param("d", $id);
        //         $stmt->execute();
        //         $stmt->bind_result($name, $surname, $email, $phone);
        //         $stmt->fetch();

        //         // Insert data into enrolled_student table
        //         $stmt1 = $conn->prepare("INSERT INTO fee_records (stud_id, stud_name, stud_surname, course_name, price) VALUES (?, ?, ?, ?, ?)");
        //         $stmt1->bind_param("dsssd", $id, $name, $surname, $c_name, $price);

        //         // Insert data into fee_records table
        //         $stmt2 = $conn->prepare("INSERT INTO enrolled_student (stud_id, stud_name, stud_surname, email, phone_no, course_name) VALUES (?, ?, ?, ?, ?, ?)");
        //         $stmt2->bind_param("dssss", $id, $name, $surname, $email, $phone, $c_name);

        //         // Execute the first query
        //         if ($stmt1->execute() && $stmt2->execute()) {
        //             // Commit the transaction if both queries were successful
        //             $conn->commit();
        //             echo "Data inserted into both tables successfully.";
        //         } else {
        //             // Rollback the transaction if any query fails
        //             $conn->rollback();
        //             echo "Error: " . $conn->error;
        //         }

        //         $conn->close();


        //     header("Location: recipt.php?id=". urlencode($id));
        //     exit(); // Make sure to exit to prevent further script execution
        // }   

    ?>

    <?php

            
// if (isset($_POST['redirect_button'])) {
//     // Call the function when the button is clicked
//     redirectToNewPage();
// }
// else
// {
//     echo 'This button no click';
// }

// // Define a PHP function for redirection
// function redirectToNewPage() {
//     require_once 'connection.php'; // Include the database connection file

    
//         // Define the SELECT query
//         // $sql = "SELECT id, name, surname, email, phone FROM student WERE ";
//         $stmt = $conn->prepare("SELECT name, surname, email, phone FROM student WHERE id = ?");
//         $stmt->bind_param("d", $id);
//         $stmt->execute();
//         $stmt->bind_result($name, $surname, $email, $phone);
//         $stmt->fetch();

//         // Insert data into enrolled_student table
//         $stmt1 = $conn->prepare("INSERT INTO fee_records (stud_id, stud_name, stud_surname, course_name, price) VALUES (?, ?, ?, ?, ?)");
//         $stmt1->bind_param("dssss", $id, $name, $surname, $c_name, $price);

//         // Insert data into fee_records table
//         $stmt2 = $conn->prepare("INSERT INTO enrolled_student (stud_id, stud_name, stud_surname, email, phone_no, course_name) VALUES (?, ?, ?, ?, ?, ?)");
//         $stmt2->bind_param("dsssss", $id, $name, $surname, $email, $phone, $c_name);

//         // Execute the first query
//         if ($stmt1->execute() && $stmt2->execute()) {
//             // Commit the transaction if both queries were successful
//             $conn->commit();
//             echo "Data inserted into both tables successfully.";
//         } else {
//             // Rollback the transaction if any query fails
//             $conn->rollback();
//             echo "Error: " . $conn->error;
//         }

//         $conn->close();


//     header("Location: recipt.php?id=". urlencode($id));
//     exit(); // Make sure to exit to prevent further script execution
// }  
    ?>

    <!-- <script>
        const showPaymentButton = document.getElementById('show-payment');
        const paymentBox = document.getElementById('payment-box');
        const payButton = document.getElementById('pay-button');
        const backButton = document.getElementById('back-button');

        showPaymentButton.addEventListener('click', function() {
            paymentBox.style.display = 'block';
        });

        payButton.addEventListener('click', function() {
            // Implement payment logic here
            alert('Payment Successful');
        });

        backButton.addEventListener('click', function() {
            paymentBox.style.display = 'none';
        });
    </script> -->
</body>
</html>
