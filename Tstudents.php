<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        /* body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
        } */
        table {
            border-collapse: collapse;
            width: 99%;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #d3dae6;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
<body>
<?php
         require_once 'connection.php'; // Include the database connection file
    
         $subject = $_GET['sub'];

         if(isset($subject))
         {

        
            // $stmt_check_fee_2 = $conn->prepare("SELECT COUNT(*) FROM fee_records WHERE stud_id = ?");
            // $stmt_check_fee_2->bind_param("d", $id);
            // $stmt_check_fee_2->execute();
            // $stmt_check_fee_2->bind_result($fee_count);
            
            // $stmt_check_fee->execute();
            // $stmt_check_fee->bind_result($s_name, $s_sirname, $c_name, $price, $c_on);
            // $stmt_check_fee->fetch();

            $stmt = $conn->prepare("SELECT stud_id, stud_name, stud_surname, email, phone_no FROM enrolled_student WHERE course_name = ?");
            $stmt->bind_param("s", $subject);
            
                    if($stmt->execute())
                    {
                        // $stmt_check_fee->bind_result($s_name, $s_sirname, $c_name, $price, $c_on);
                        // Check the number of rows affected
                        $result = $stmt->get_result(); //new line
                        // $stmt_check_fee->store_result();

                        if ($result->num_rows > 0) 
                        {
                            
                        // $stmt_check_fee->fetch();

                        echo '
                        <table border="1">
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        </tr>
                        ';
                        while ($row = $result->fetch_assoc()) 
                        {
                            echo '
                            <br>
                                <tr>
                                    <td>'.$row["stud_id"].'</td>
                                    <td>'.$row["stud_name"].' '.$row["stud_surname"].'</td>
                                    <td>'.$row["email"].'</td>
                                    <td>'.$row["phone_no"].'</td>
                                </tr>
                                ';
                            }
                            echo '
                            </table>
                            ';
                        $stmt->close();
                        
                        }
                        else
                        {
                            echo '
                            <br>
                            <div class = "recipt" style = "background-color : ghostwhite;
                            border: 1px solid #141180; border-radius: 8px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                            padding : 15px;">
                            <h3 style = " color: #141180;">No Data Found !!!</h3>
                            </div>
                            ';
                        }
                    }
                    else
                    {
                        echo 'error while exectuing database query';
                    }
            }
           
                // echo '
                // <br>
                // <div class = "recipt">
                // <h3>No Data Found !!!</h3>
                // </div>
                // ';

  ?>
</body>
</html>