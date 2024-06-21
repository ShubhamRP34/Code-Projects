<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .recipt {
        background-color : ghostwhite;
        border: 1px solid #141180;
        border-radius: 8px;
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        padding : 15px;
    }

    .recipt h3 {
        color: #141180;
    }
</style>
<body>
  <?php
         require_once 'connection.php'; // Include the database connection file
    
         $id = $_GET['id'];

         if(isset($id))
         {

        
            // $stmt_check_fee_2 = $conn->prepare("SELECT COUNT(*) FROM fee_records WHERE stud_id = ?");
            // $stmt_check_fee_2->bind_param("d", $id);
            // $stmt_check_fee_2->execute();
            // $stmt_check_fee_2->bind_result($fee_count);
            
            // $stmt_check_fee->execute();
            // $stmt_check_fee->bind_result($s_name, $s_sirname, $c_name, $price, $c_on);
            // $stmt_check_fee->fetch();

            $stmt_check_fee = $conn->prepare("SELECT stud_name, stud_surname, course_name, price, created_on FROM fee_records WHERE stud_id = ? ORDER BY created_on DESC");
            $stmt_check_fee->bind_param("d", $id);
            
                    if($stmt_check_fee->execute())
                    {
                        // $stmt_check_fee->bind_result($s_name, $s_sirname, $c_name, $price, $c_on);
                        // Check the number of rows affected
                        $result = $stmt_check_fee->get_result(); //new line
                        // $stmt_check_fee->store_result();

                        if ($result->num_rows > 0) 
                        {
                            
                        // $stmt_check_fee->fetch();

                        
                        while ($row = $result->fetch_assoc()) 
                        {
                            echo '
                            <br>
                            <div class = "recipt">
                            <h3>Course : '.$row["course_name"].'</h3>
                            <h3>Amount : '.$row["price"].'</h3>
                            <h3>Date : '.$row["created_on"].'</h3>
                            </div>
                            ';
                        }
                        $stmt_check_fee->close();
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