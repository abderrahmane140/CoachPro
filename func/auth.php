<?php

require '../config/dbConnection.php';

//handle the register 

$errors = [];

if($_SERVER["REQUEST_METHOD"]  === 'POST' && isset($_POST['register'])) {


    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if(empty($username) || empty($email) || empty($password)  || empty($role)){
        $errors[] = 'All fields are required!';
    }else{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email',$email);
        $stmt->execute();


        if($stmt->rowCount() > 0) {
            $errors[] = "Email is already registered!";
        }


        if(empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password , :role)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

        }
    }
}

?>