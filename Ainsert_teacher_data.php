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
            color : white;
        }
        .label{font-size : 20px; font-family:Georgia, 'Times New Roman', Times, serif; color : white;}
</style>
<body>
    <br>
<form action="Asubmit_to_server.php" method="post" enctype="multipart/form-data" class = "form_container">
            <!-- Name -->
            <!-- <h1 style="color: white; font-size: 60px; font-family:Georgia, 'Times New Roman', Times, serif;">Student Information</h1> -->
            <label for="name">Name</label><br><br>
            <input type="text" id="name" name="name" required style="width: 220px;"><br><br>

            <!-- Surname -->
            <label for="surname">Surname</label><br><br>
            <input type="text" id="surname" name="surname" required><br><br>

            <!-- Email -->
            <label for="email">Email</label><br><br>
            <input type="email" id="email" name="email" required style="width: 220px;"><br><br>

            <label for="surname">Course</label><br><br>
            <input type="text" id="course" name="course" required><br><br>

            <label for="surname">Teacher id</label><br><br>
            <input type="text" id="teacher_id" name="teacher_id" required><br><br>

            <!-- Adhar No -->
            <label for="adhar">Adhar No</label><br><br>
            <input type="text" id="adhar" name="adhar" pattern="[0-9]{12}" title="12 digits required" style="width: 220px;"><br><br>

            <!-- gnender label -->
                <label for="gender">Gender</label><br><br>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <!-- <option value="other">Other</option> -->
                </select><br><br>

            <!-- Phone No -->
            <label for="phone">Phone No</label><br><br>
            <input type="text" id="phone" name="phone" pattern="[0-9]{10}" title="10 digits required" style="width: 220px;" required><br><br>

            <!-- teacher Photo -->
            <label for="photo">Teacher Photo (jpg < 64kb)</label><br><br>
                    <input type="file" id="photo" name="photo" accept=".jpg" required><br><br>

            <a href="log in.html"><input type="submit" value="Submit" style="padding: 12px; background-color :cornflowerblue; border-color : cornflowerblue; width: 130px; font-size: 17px; border-radius: 15px;"></a>
        </form>
</body>
</html>