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
    <form action="Tupload_pdf_to_server.php?sub=<?php echo $subject; ?>&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
        
    <label for="Title" class = "label">Title</label><br><br>
    <input type="text" id="name" name="Title" required style="width : 400px; height : 20px;border-radius : 3px;" placeholder="Enter your Assignment title" ><br><br>
        
    <label for="description" class = "label">Description</label><br><br>
    <input type="text" name="description" id="textbox" placeholder="Enter your Assignment description" style = "border-radius : 3px;height : 100px; width : 400px;"><br><br>

    <label for="ldate"style="margin-right: 44px;">Submission last date</label>
    <input type="date" id="birthdate" name="ldate" pattern="\d{2}\/\d{2}\/\d{2}" title="dd/mm/yy format" style="width: 220px;"><br><br>

    <label for="pdf"  class = "label">Assignment (.pdf)</label>
    <input type="file" id="photo" name="pdf" accept=".pdf" required><br><br>

    <input type="submit" value="upload" style="padding: 8px; background-color :cornflowerblue; border-color : cornflowerblue; width: 100px; font-size: 17px; border-radius: 15px;">    
    </form>
</div>
</body>
</html>