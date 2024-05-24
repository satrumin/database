<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container my-5" >
        <h2>Student Informatoin </h2>
        <a class="btn btn-primary" href="/student/create.php" role="button">New Student</a><br>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>ID </th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Programme</th>
            <th>Email</th>
            <th>Year Of Study</th>
            <th>Education level</th>
            <th>Health Status</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        </thead>
        <tbody>
            <?php
             $servername="localhost";
             $username= "root";
             $password= "";
             $dbname= "studentdatabase";

             //establish connection to database
             $conn = new mysqli($servername, $username, $password,$dbname);
             //check connection
             if ($conn->connect_error) {
                die("Connection Failed". $conn->connect_error);
             }
             //read row from database
             $sql = "SELECT *FROM studentinformation";
             $result = $conn->query($sql);
             //check if quer is executed correct or not
             if (!$result) {
                die("Invalid query:". $conn->connect_error);
             }
             //read data of each row
             while ($row = $result->fetch_assoc()) {
                echo"
                <td>$row[ID]</td>
                <td>$row[First_Name]</td>
                <td>$row[Last_Name]</td>
                <td>$row[Programme]</td>
                <td>$row[Email]</td>
                <td>$row[Year_Of_Study]</td>
                <td>$row[Education_level]</td>
                <td>$row[Health_Status]</td>
                <td>$row[Address]</td>
                <td>$row[ID]</td>
                <td>$row[ID]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/student/edit.php?ID=$row[ID]'>Update</a>
                    <a class='btn btn-danger btn-sm' href='/student/delete.php?ID=$row[ID]'>Delete</a>
                </td>
                
                ";
             }
                
            ?>
           
        </tbody>
        
    </table>
</body>
</html>