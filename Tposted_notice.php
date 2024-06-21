<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            .container {
                /* text-align: center; */
                background-color: #dfe0a2;
                padding : 3px;
                border : 1px solid black;
                border-radius: 5px;
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
            }
            
            .control-div p{ 
                transition: 2s;
                margin-left : 10px;
                font-size: 20px;
            }
 
#toggle-button {
    background-color: #0d188c;
    color: white;
    border : none;
    border-radius: 3px;
    cursor: pointer;
    width : 60px;
    margin-left: 10px;
    /* margin-top: -100px; */
}

.content-div {
    /* display: none; */
    border: 1px solid #ccc;
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 10px; 
    /* margin : auto; */
    background-color: #111f85;
    border : 1px solid black;
    border-radius: 5px;
    margin-left : 10px;
}


    </style>
</head>
<body>
<?php

    require_once 'connection.php'; // Include the database connection file

    $subject = $_GET['sub'];

    if(isset($subject))
    { 

       $stmt_fetch_videos = $conn->prepare("SELECT title, draft, created_on FROM educational_notice WHERE subject = ? ORDER BY created_on DESC");
       $stmt_fetch_videos->bind_param("s", $subject);
       
               if($stmt_fetch_videos->execute())
               {
                   
                   $result = $stmt_fetch_videos->get_result(); //new line

                   if ($result->num_rows > 0) 
                   {
      
                   while ($row = $result->fetch_assoc()) 
                   {
                       echo '
                       <br>
                       <div class="container">
                       <div class="control-div">
                           <p><span style = "font-weight : bold;">Subject :</span> '.$row["title"].'</p>
                           <div style = "border : 4px soild black"></div>
                           <p>'.$row["draft"].'</p>
                           <p><span style = "font-weight : bold;">Date :</span> '.$row["created_on"].'</p>
                       </div>
                       </div>
                       ';
                   }
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

</body>
</html>