<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form_container{
            background-color : #191573;
            color : white;
            border-radius : 5px;
            padding : 10px;
            border : 2px solid #14115c;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .label{font-size : 20px; font-family:Georgia, 'Times New Roman', Times, serif;}
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
    <form action="Tupload_notice_to_server.php?sub=<?php echo $subject; ?>&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
        
    <label for="Title" class = "label">Subject</label><br><br>
    <input type="text" id="name" name="Title" required style="width : 400px; height : 20px;border-radius : 3px;" placeholder="Enter your sub" ><br><br>
        
    <label for="description" class = "label">Description</label><br><br>
    <input type="text" name="description" id="textbox" placeholder="Enter your notice" style = "border-radius : 3px;height : 100px; width : 700px;"><br><br>

    <input type="submit" value="post" style="padding: 8px; background-color :cornflowerblue; border-color : cornflowerblue; width: 100px; font-size: 17px; border-radius: 15px;">    
    </form>
</div>
</body>
</html>