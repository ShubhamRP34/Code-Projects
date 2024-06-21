<!-- 
        <?php
        // Include the connection.php file to establish a database connection
        // include('connection.php');

        // // Create a SQL query to fetch data from the courses table
        // // $query = "SELECT * FROM courses";

        // // Execute the query
        // // $result = mysqli_query($connection, $query);

        // $stmt = $conn->prepare("SELECT * FROM courses");
        // $stmt->execute();
        // $result = $stmt->get_result();


        // Check if the query was successful
        // if ($result) {
        //     // Fetch and display the data in a table
        //     while ($row = $result->fetch_assoc()) {
        //         // echo "<tr>";
        //         // echo "<td>" . $row['course_id'] . "</td>";
        //         // echo "<td>" . $row['course_name'] . "</td>";
        //         // echo "<td>" . $row['instructor'] . "</td>";
        //         // echo "<td>" . $row['enrollment'] . "</td>";
        //         // echo "</tr>";

        //         echo '
        //         <div class="card-container">
        //         <div class="card">
        //         <img src="'.$row["image"].'" class="card-img-top" alt="...">
        //         <div class="card-body">
        //             <h5 class="card-title">'.$row["course_name"].'</h5>
        //             <p class="card-text">'.$row["teacher_name"].'</p>
        //             <p class="card-text">Description : '.$row["description"].'</p>
        //             <p class="card-text">Duration : '.$row["duration"].'</p>
        //             <p class="card-text">Fee : '.$row["price"].'</p>
        //             <p class="card-text">Reginstration deadline : '.$row["registration_final_date"].'</p>
        //         </div>
        //         </div>
        //         </div>

        //         ';
        //     }
        // } else {
        //     // echo "Error: " . mysqli_error($connection);
        //     echo '
        //     <div class="message-box" id="messageBox2" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
        //         <p>Error Data not found</p>
        //         <button class="ok-button" onclick="messageBox2.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">OK</button>
        //     </div>';
        // }

        // // Close the database connection
        // mysqli_close($connection);
        ?> -->







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Add this to the <head> section of your HTML file -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <style>
        
.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start; /* Change to 'flex-start' */
    gap: 10px; /* Adjust the gap as needed */
}

.col {
    flex: 0 0 calc(22% - 1px); /* Adjust the width and margin as needed */
    margin: 10px;
    background-color: ghostwhite;
    border: 1px solid #ced4da;
    border-radius: 8px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
    transition : 0.3s;
}

.col:hover{
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.8);
    background-color : #c7d1f2;
    transition : 0.3s;
}



.card {
    width: 100%;
}

.card-img-top {
    max-width: 100%;
    height: 200px;
}

.card-body {
    padding: 30px;
    text-align: left;
}

.card-title {
    font-size: 20px;
    font-weight: bold;
    margin: 0;
}

.card-text {
    font-size: 16px;
    line-height: 1.4;
    margin: 10px 0;
}

.register {
    background-color : rgb(12, 12, 212);
    color : white;
    border-color: rgb(12, 12, 212);
    padding: 5px;
    border-radius: 5px;
    width: 100px;
    transition : 0.5s;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); */
}

.register:hover {
    background-color : black;
    border-color : black;
    transition : 0.5s;
}


/* payment box design */
        /* .message-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 400px;
            text-align: center;
        } */

        /* .message-box h1 {
            text-align: center;
        }

        .message-box p {
            color: blue;
        }

        .ok-button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        /* Styles to show the payment box on button click */
        /* .register:focus + .message-box {
            display: block;
        }

        .message-box .ok-button {
            display: block;
        } */ 
    </style>
</head>


<?php
        // tion.php file to establish a database connection
        include('connection.php');

        $id = $_GET['id'];

        if (isset($id))
        {

            
            $type_array = array("Business", "Arts", "IT", "Digital Marketing", "Science");
            
            // Loop through the type_array
            foreach ($type_array as $type) {
            $stmt = $conn->prepare("SELECT * FROM courses WHERE type = '$type'");
            $stmt->execute();
            $result = $stmt->get_result();
            
            $row = $result->fetch_assoc();
            $typeValue = $row['type']; 

            echo '
            <h1 style = "margin-left : 10px; font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;">'.$typeValue.'</h1>';
            echo '<div class="row">';
            

            foreach ($result as $row)
            {
                echo '
                <div class="col">
                <div class="card">
                <img src="'. $row["Image"].'" class="card-img-top" alt="Card 1">
                <div class="card-body">
                <h5 class="card-title">' . $row["course_name"] . '</h5>
                <p class="card-text">' . $row["teacher_name"] . '</p>
                    <p class="card-text">Description : ' . $row["description"] . '</p>
                    <p class="card-text">Duration : ' . $row["duration"] . '</p>
                    <p class="card-text">Fee : ' . $row["price"] . '</p>
                    <p class="card-text">Registration Ends : '. $row["registration_final_date"] . '</p>
                    <a href="payment.php?int='.$row['price'].'&id='.$id.'&c_name='.$row['course_name'].'">
                    <button class = "register" id = "payment">Register</button>
                    </a>
                    </div>
                    </div>
                </div>
                ';
                
            }
            
            echo '</div>';
            
        }
        
        }
        ?>

<div class="payment-box" style="visibility : hidden;">
                    <h2>Payment Details</h2>
                        <p>Price: <span class="price"></span></p>
                        <!-- Add more payment details here -->
                    </div>

<script>
    function showPaymentBox() {
    const paymentBox = document.querySelector('.payment-box'); // Change this selector if needed
    // const priceElement = paymentBox.querySelector('.price');

    // // Set the price in the payment box
    // priceElement.textContent = 'Price: ' + price;

    // Display the payment box
    // paymentBox.style.display = 'block';
    // paymentBox.style.visibility = 'visible';
    // paymentBox.style.visibility = 'visible';
    console.log("hello world")
}
</script>

<!-- <script>
    // Get all elements with class "register"
    const registerButtons = document.querySelectorAll('.register');

    // Loop through all "register" buttons and add a click event listener
    registerButtons.forEach((button) => {
        button.addEventListener('click', function() {
            // Get the associated payment box for this button
            const paymentBox = this.nextElementSibling;

            // Get the price from the data attribute
            const price = this.getAttribute('data-price');

            // Set the price in the payment box
            const priceElement = paymentBox.querySelector('.price');
            priceElement.textContent = price;

            // Toggle the visibility of the payment box
            paymentBox.style.display = (paymentBox.style.display === 'block') ? 'none' : 'block';
        });
    });
</script> -->

<!-- <script>
        const scrollBox = document.querySelector('.scroll-box');
        const scrollLeft = document.getElementById('scroll-left');
        const scrollRight = document.getElementById('scroll-right');
        const items = document.querySelectorAll('.item');
        let scrollPosition = 0;
        const itemWidth = 220; // Adjust to the width of your items
        const containerWidth = document.querySelector('.container').offsetWidth;
        const contentWidth = document.querySelector('.scroll-box').scrollWidth;
        const lastItem = items[items.length - 1];

        scrollLeft.addEventListener('click', function() {
            scrollPosition += itemWidth;
            scrollPosition = Math.min(scrollPosition, 0);
            scrollBox.style.transform = `translateX(${scrollPosition}px)`;
        });

        scrollRight.addEventListener('click', function() {
            const maxScroll = containerWidth - contentWidth;
            const lastItemPosition = lastItem.offsetLeft + lastItem.offsetWidth;

            if (scrollPosition > maxScroll) {
                scrollPosition -= itemWidth;
                scrollPosition = Math.max(scrollPosition, maxScroll);
                scrollBox.style.transform = `translateX(${scrollPosition}px)`;
            }
        });
    </script>  -->

    <?php
    // Check if the AJAX request was made
    // if (isset($_POST['payment'])) {
    //     // Place the PHP code you want to run here
    //     echo "alert(php script executed)";
    //     // exit; // Stop executing the rest of the script

    //     if (isset($_POST['price'])) {
    //         $price = $_POST['price'];
    //         // Place the PHP code you want to run using the $price variable
    //         // echo "PHP script executed with price: " . $price;
    //         // exit; // Stop executing the rest of the script
            
    //         echo '
    //         <div class="message-box" id="paymentbox" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; border: 1px solid #ccc; padding: 20px; max-width: 400px; text-align: center;">
    //         <h1 style = "text-align : center;">Pay</h1>
    //         <p style="color: blue;">'.$price.'</p>
    //         <button class="ok-button" onclick="paymentbox.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">pay</button><br>
    //         <button class="ok-button" onclick="paymentbox.style.display = \'none\'" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">Cancel</button>
    //         </div>
    //         ';
    //     }
    // }
    ?>
<!-- 
    <script>
        document.getElementById('payment').addEventListener('click', function() {

            var price = this.getAttribute('data-price');

            // Send an AJAX request to the same script
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'courses.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Log the response (if any)
                }
            };
            // xhr.send('payment=1');
            // xhr.send('payment&price=' + price);
            xhr.send('payment = 1&price=' + price);
        });
    </script> -->

    <!-- <script>
    document.getElementById('payment').addEventListener('click', function() {
        try {
            var price = this.getAttribute('data-price');

            // Send an AJAX request to the same script
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'student_dashbord.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Log the response (if any)
                } else {
                    throw new Error('Request failed with status: ' + xhr.status);
                }
            };
            xhr.send('payment=1&price=' + price);
        } catch (error) {
            // alert('An error occurred: ' + error.message);
            console.log('An error occurred: ' + error.message);
        }
    });
    </script> -->


    <!-- <button class="register" id="payment" data-price="123">Register</button> -->




    <script>
//     document.getElementById('payment').addEventListener('click', function() {
//         var price = this.getAttribute('data-price');
//         document.getElementById('pricePlaceholder').textContent = price; // Set the price in the message box
//         document.getElementById('paymentbox').style.display = 'block'; // Display the message box
//     });

//     function handlePayment(action) {
//         var price = document.getElementById('pricePlaceholder').textContent;
        
//         // Perform further actions based on the 'action' parameter (e.g., send the payment information to PHP)
//         if (action === 'pay') {
//             // Example: Send a request to PHP with the price
//             // You can use AJAX for this purpose.
//             // You can use the 'price' variable to send the price to PHP.
//             alert('Payment confirmed for price: ' + price);
//         } else if (action === 'cancel') {
//             alert('Payment canceled');
//         }

//         // Close the message box
//         document.getElementById('paymentbox').style.display = 'none';
//     }
// </script>

      <!-- Message box for payment -->
      <!-- <div class="message-box">
        <h1>Pay</h1>
        <p>Price: <span>123</span></p>
        <button class="ok-button">Pay</button><br>
        <button class="ok-button">Cancel</button>
    </div> -->
   
</body>
</html>