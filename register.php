<?php

$servername = "localhost";  
$username = "root";  
$password = "";  
$dbname = "register";  


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$user = $_POST['username'];
$pass =$_POST['password'];
$age = $_POST['age'];


$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo"alredy ther";
    
} else {

    $sql = "INSERT INTO users (name, username, password, age) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $user, $pass, $age); 


    if ($stmt->execute()) {
        header("Location: http://localhost/dont/home.html");
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>

