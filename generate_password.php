<?php
require_once 'db_config.php';

function generatePassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';
    $password = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }

    return $password;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Generate a password
    $password = generatePassword();

    // Store user details and password in the database
    $stmt = $conn->prepare("INSERT INTO users (name, gender, age, phone, email, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $name, $gender, $age, $phone, $email, $password);
    $stmt->execute();

    // Return the generated password
    echo $password;
}
?>