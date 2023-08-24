<?php
// Establish connection to MySQL
$server = "localhost";
$user = "root";
$password = "";
$db = "signup";

$conn = new mysqli($server, $user, $password, $db);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $input_otp = $_POST["otp"];

    // Retrieve the generated OTP from the database (assuming you have stored it)
    $sql = "SELECT otp FROM registration where id = 29"; // Assuming you have stored the generated OTP in the 'users' table with an 'id' of 1
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $generated_otp = $row["otp"];

        // Verify if input OTP matches with the generated OTP
        if ($input_otp == $generated_otp) {
            echo "OTP verification successful.";
            // Perform any additional actions or redirect to another page after successful OTP verification
        } else {
            echo "OTP verification failed.";
        }
    } else {
        echo "No OTP found.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container w-50 h-50 mt-5 bg-primary rounded">
        <div class="row">
        <h1 style="text-align:center;margin-top:40px;">OTP Verification</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div style="text-align:center;">
    <label for="otp">Enter OTP:</label>
        <input class="rounded" type="text" id="otp" name="otp" required><br><br>
        <input  class="rounded w-50" style="font-size:25px" type="submit" value="Verify">
    </div>
        </form>
        </div>
    
    </div>
    
</body>
</html>


