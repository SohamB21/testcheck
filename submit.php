<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
</head>
<body>

<h2>Form Submission</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php'; 

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    $sql = "INSERT INTO submissions (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Record added successfully</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>