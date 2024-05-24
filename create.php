<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdatabase";

// Establish connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

$ID = "";
$First_Name = "";
$Last_Name = "";
$Programme = "";
$Email = "";
$Year_of_Study = "";
$Education_Level = "";
$Health_Status = "";
$Address = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ID = $_POST["ID"];
    $First_Name = $_POST["First_Name"];
    $Last_Name = $_POST["Last_Name"];
    $Programme = $_POST["programme"];
    $Email = $_POST["email"];
    $Year_of_Study = $_POST["Year_of_Study"];
    $Education_Level = $_POST["Education_Level"];
    $Health_Status = $_POST["Health_Status"];
    $Address = $_POST["address"];

    if (empty($ID) || empty($First_Name) || empty($Last_Name) || empty($Programme) || empty($Email) || empty($Year_of_Study) || empty($Education_Level) || empty($Health_Status) || empty($Address)) {
        $errorMessage = "All fields are required";
    } else {
        // Add new student to the database
        $sql = "INSERT INTO studentinformation (`ID`, `First Name`, `Last Name`, `Programme`, `Email`, `Year Of Study`, `Education level`, `Health Status`, `Address`) " .
               "VALUES ('$ID', '$First_Name', '$Last_Name', '$Programme', '$Email', '$Year_of_Study', '$Education_Level', '$Health_Status', '$Address')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        } else {
            // Reset fields after successful submission
            $ID = "";
            $First_Name = "";
            $Last_Name = "";
            $Programme = "";
            $Email = "";
            $Year_of_Study = "";
            $Education_Level = "";
            $Health_Status = "";
            $Address = "";

            $successMessage = "Student added";

            // Direct user to home page
            header("location:/student/index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Student</h2>
        
        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-danger'>$errorMessage</div>";
        } elseif (!empty($successMessage)) {
            echo "<div class='alert alert-success'>$successMessage</div>";
        }
        ?>
        <form action="create.php" method="post">
            <div class="mb-3">
                <label for="ID" class="form-label">ID</label>
                <input type="text" class="form-control" id="ID" name="ID" required>
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="First_Name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="Last_Name" required>
            </div>
            <div class="mb-3">
                <label for="programme" class="form-label">Programme</label>
                <input type="text" class="form-control" id="programme" name="programme" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="year_of_study">Year of Study:</label><br>
                   <select id="year_of_study" name="Year_of_Study" required>
                      <option value="1">First Year</option>
                      <option value="2">Second Year</option>
                      <option value="3">Third Year</option>
                      <option value="4">Fourth Year</option>
                </select><br><br>
            </div>
            <div class="mb-3">
                <label for="education_level">Education Level:</label><br>
                 <select id="education_level" name="Education_Level" required>
                     <option value="certificate">Certificate</option>
                     <option value="diploma">Diploma</option>
                     <option value="bachelor">Bachelor</option>
                 </select><br><br>
            </div>
            <div class="mb-3">
               <label for="health_status">Health Status:</label><br>
                   <select id="health_status" name="Health_Status" required>
                        <option value="none_disability">None Disability</option>
                        <option value="disability">Disability</option>
                   </select><br><br>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <!---display a success message---->
            <?php
             if(!empty($successMessage)){
                echo "";
             }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>
</html>
