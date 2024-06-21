<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
     .form_container{
            background-color : #1f347a;
            border-radius : 5px;
            padding : 10px;
            border : 2px solid #162557;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .label{font-size : 20px; font-family:Georgia, 'Times New Roman', Times, serif; color : white;}
</style>
<body>
    <br>
<form action="Asearch_table_result.php" method="post" enctype="multipart/form-data" class = "form_container">
        
        <label for="Table_name" class = "label">Table Name</label><br><br>
        <input type="text" id="name" name="Table" required style="width : 400px; height : 20px;border-radius : 3px;" placeholder="  Enter table name" ><br><br>

        
        <!-- <label for="Title" class = "label">Table</label><br><br>
        <input type="text" id="name" name="Title" required style="width : 400px; height : 20px;border-radius : 3px;" placeholder="Enter your Assignment title" ><br><br> -->
    
    
        <input type="submit" value="Search" style="padding: 8px; background-color :cornflowerblue; border-color : cornflowerblue; width: 100px; font-size: 17px; border-radius: 15px;">    
</form>
</body>
</html>