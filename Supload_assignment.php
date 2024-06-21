<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form_container{
            background-color : #1f347a;
            border-radius : 5px;
            padding : 10px;
            border : 2px solid #162557;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .label{font-size : 20px; font-family:Georgia, 'Times New Roman', Times, serif;}

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
        label {color : white;}
    </style>
</head>
<body>

<?php
    require_once 'connection.php'; // Include the database connection file
    $subject = $_GET['sub'];
    $id = $_GET['id'];
?>

<br>
<div class = "form_container">
    <form action="Supload_assignment_to_server.php?sub=<?php echo $subject; ?>&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
        
    <label for="Title" class = "label">Title</label><br><br>
    <input type="text" id="name" name="Title" required style="width : 400px; height : 20px;border-radius : 3px;" placeholder="Enter your Assignment title" ><br><br>

    <label for="pdf"  class = "label">Assignment (.pdf)</label>
    <input type="file" id="photo" name="pdf" accept=".pdf" required style = "color : white;"><br><br>

    <input type="submit" value="upload" style="padding: 8px; background-color :cornflowerblue; border-color : cornflowerblue; width: 100px; font-size: 17px; border-radius: 15px;">    
    </form>
</div>


<?php
    if(isset($subject))
    { 

       $stmt_fetch_videos = $conn->prepare("SELECT name, title, subject, pdf, created_at FROM educational_student_assignment WHERE subject = ? ORDER BY created_at DESC");
       $stmt_fetch_videos->bind_param("s", $subject);
       
               if($stmt_fetch_videos->execute())
               {
                   
                   $result = $stmt_fetch_videos->get_result(); //new line

                   if ($result->num_rows > 0) 
                   {
      
                    echo '
                    <table border="1">
                    <tr>
                    <th>Name</th>
                    <th>Title</th>
                    <th>File</th>
                    <th>Subject</th>
                    <th>Uploaed_On</th>
                    </tr>
                    ';
                    while ($row = $result->fetch_assoc()) 
                    {
                        echo '
                        <br>
                            <tr>
                                <td>'.$row["name"].'</td>
                                <td>'.$row["title"].'</td>
                                <td>'.$row["pdf"].'</td>
                                <td>'.$row["subject"].'</td>
                                <td>'.$row["created_at"].'</td>
                            </tr>
                            ';
                    }
                    echo '
                    </table>
                    ';


                
                   $stmt_fetch_videos->close();
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
?>
 
<!-- <br> -->
<!-- <div class = "form_container">
    <form action="Supload_assignment_to_server.php?sub=<?php echo $subject; ?>&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
        
    <label for="Title" class = "label">Title</label><br><br>
    <input type="text" id="name" name="Title" required style="width : 400px; height : 20px;border-radius : 3px;" placeholder="Enter your Assignment title" ><br><br>

    <label for="pdf"  class = "label">Assignment (.pdf)</label>
    <input type="file" id="photo" name="pdf" accept=".pdf" required><br><br>

    <input type="submit" value="upload" style="padding: 8px; background-color :cornflowerblue; border-color : cornflowerblue; width: 100px; font-size: 17px; border-radius: 15px;">    
    </form>
</div> -->
</body>
</html>