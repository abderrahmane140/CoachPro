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


            header('Location: /CoachPro/pages/coach/dashboard.php');
        }
    }
}

//handle the login


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password)){
        $errors[] = 'Both feild are required!';
    }else{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if($user && password_verify($password, $user['password'])){
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];


            header('Location: /CoachPro/pages/coach/dashboard.php');
            exit();
         }else{
            $errors[] = "Invalid email or passowrd!";
         }
    }
}

?>