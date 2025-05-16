<?php 
session_start();
include 'connect.php';

if (isset($_POST['signUp'])) {
    
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $student_number  = trim($_POST['student_number']);
    $contact = trim($_POST['contact']);
    $module_code = trim($_POST['module_code']);
    $email = trim($_POST['email']); 
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Checking if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "Email already exists! Use another.";
    } else {
        if ($password === $confirm_password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("
                INSERT INTO users (name, surname, student_number, module_code, email,contact,password)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("ssissss", $name, $surname,
             $student_number, $module_code, $email, $contact, $hash);

            if ($stmt->execute()) {
                echo "Registered successfully. Redirecting...";
                header("Location: index.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Passwords don't match. Please try again.";
        }
    }

    $checkEmail->close();
}


if (isset($_POST['signIn'])) {
    $loginmail = trim($_POST['loginmail']);
    $loginpass = $_POST['loginpass'];

    $query = $conn->prepare("SELECT id, email, password
     FROM users WHERE email = ?");
    $query->bind_param("s", $loginmail);
    $query->execute(); 
    $query->store_result();

    if ($query->num_rows > 0) {
        $query->bind_result($user_id, $mail, $hash);
        $query->fetch();

        if (password_verify($loginpass, $hash)) {
            $_SESSION['user_id'] =  $user_id;
            $_SESSION['email'] = $mail;
            header("Location: homepage.php");
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that email.";
    }

    $query->close();
}
?>
