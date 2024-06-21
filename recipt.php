<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <style>
      #content {
    border: 1px solid #ccc;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 5px;
    background-color: #dedede;
    border: 1px solid black;
    }
    #content h1 {
        text-align: center;
        color: #141180;
    }
    #content h2 {text-align: center; color: #141180;}
    #content p {margin-left: 20px; font-size: 20px;}
    #content button {margin-left: 20px; background-color:darkturquoise; border-color:darkturquoise; color : black; padding: 10px; border-radius: 5px;}

    </style>
</head>
<body>
    <!-- <h1>This is recipt page</h1> -->
    <?php

        require_once 'connection.php'; // Include the database connection file
    
        $id = $_GET['id'];
        $price = $_GET['int'];
        $c_name = $_GET['c_name'];

        if (isset($price)) 
        {
            if(isset($c_name))
            {
                if(isset($id))
                {

                    //storinng data into database
                    // Check if stud_id already exists in enrolled_student
                    $stmt_check_enrolled = $conn->prepare("SELECT COUNT(*) FROM enrolled_student WHERE stud_id = ?");
                    $stmt_check_enrolled->bind_param("d", $id);
                    $stmt_check_enrolled->execute();
                    $stmt_check_enrolled->bind_result($enrolled_count);
                    $stmt_check_enrolled->fetch();
                    $stmt_check_enrolled->close();

                    // Check if stud_id already exists in fee_records
                    // $stmt_check_fee = $conn->prepare("SELECT COUNT(*) FROM fee_records WHERE stud_id = ?");
                    // $stmt_check_fee->bind_param("d", $id);
                    // $stmt_check_fee->execute();
                    // $stmt_check_fee->bind_result($fee_count);
                    // $stmt_check_fee->fetch();
                    // $stmt_check_fee->close();

                    // if ($enrolled_count > 0 || $fee_count > 0) {
                    if ($enrolled_count > 0) {
                        echo '
                        <div id = "content">
                        <div id="capture">
                            <h1>You are already register for this Course</h1><br>
                            <h1>OR</h1><br>
                            <h1>You have an active Course</h1><br>
                            <h2>For payment confirmation check your transaction section</h2><br>
                            <h2>If any problem contact us</h2><br>
                            <h1>+91 8888 7777 78</h1><br>
                            <h2>Or report on</h2><br>
                            <h1>online_course_platform@gmail.com</h1><br>
                        </div>
                        <a href="student_dashbord.php?id='.$id.'">
                        <button>back</button>
                        </a>
                        </div>
                        ';
                    } 
                    else 
                    {
                    // Query 1: SELECT data from the "student" table
                    $stmt1 = $conn->prepare("SELECT name, surname, email, phone FROM student WHERE id = ?");
                    $stmt1->bind_param("d", $id);
                    $stmt1->execute();
                    $stmt1->bind_result($name, $surname, $email, $phone);
                    $stmt1->fetch();
                    if ($stmt1->error) {
                        echo "Error in Query 1: " . $stmt1->error;
                    }
                    $stmt1->close(); // Close the first statement

                    // Query 2: INSERT data into the "fee_records" table
                    $stmt2 = $conn->prepare("INSERT INTO fee_records (stud_id, stud_name, stud_surname, course_name, price) VALUES (?, ?, ?, ?, ?)");
                    $stmt2->bind_param("dssss", $id, $name, $surname, $c_name, $price);
                    $stmt2->execute();
                    if ($stmt2->error) {
                        echo "Error in Query 2: " . $stmt2->error;
                    }
                    $stmt2->close(); // Close the first statement

                    // Query 3: INSERT data into the "enrolled_student" table
                    $stmt3 = $conn->prepare("INSERT INTO enrolled_student (stud_id, stud_name, stud_surname, email, phone_no, course_name) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt3->bind_param("dsssss", $id, $name, $surname, $email, $phone, $c_name);
                    $stmt3->execute();
                    if ($stmt3->error) {
                        echo "Error in Query 3: " . $stmt3->error;
                    }

                    $stmt4 = $conn->prepare("SELECT created_on FROM fee_records WHERE stud_id = ?");
                    $stmt4->bind_param("d", $id);
                    $stmt4->execute();
                    $stmt4->bind_result($created_on);
                    $stmt4->fetch();
                    if ($stmt4->error) {
                        echo "Error in Query 1: " . $stmt1->error;
                    }
                    $stmt4->close();

                    echo '
                    <div id = "content">
                    <div id="capture">
                        <h1>Fee Recipt</h1><br>
                        <p>Name : '.$name.' '.$surname.'</p>
                        <p>Price : '.$price.'</p>
                        <p>For : '.$c_name.'</p>
                        <p>Date : '.$created_on.'</p>
                    </div>
                    <button id="download-pdf" onclick="makePDF()">Download PDF</button>
                    <a href="student_dashbord.php?id='.$id.'">
                    <button>back</button>
                    </a>
                    </div>
                    ';
                    }
                } 
            } 
        }
    

    ?>

<script>
            window.html2canvas = html2canvas;
            window.jsPDF = window.jspdf.jsPDF;

            function makePDF()
            {

                html2canvas(document.querySelector("#capture"), {
                    allowTaint : true,
                    useCORS : true,
                    scale : 1

                }).then(canvas => {
                // document.body.appendChild(canvas)
                    var img = canvas.toDataURL("image/png");
                    var doc = new jsPDF();
                    // doc.setFont('Arial');
                    // doc.getFontSize(11);
                    doc.addImage(img, 'png', 0, 0,  210, 50);
                    doc.save("Fee Recipt");
                });

            }
        </script>
</body>
</html>