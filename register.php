<?php 
session_start();
include 'connect.php';

if (isset($_POST['signUp'])) {
    $name = trim($_POST['fname']);
    $surname = trim($_POST['lName']);
    $student_number = trim($_POST['student_number']);
    $contact = trim($_POST['contact']);
    $module_code = trim($_POST['module_code']);
    $email = trim($_POST['email']); // FIXED typo
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Checking if email exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "Email exists. Use another.";
    } else {
        if ($password === $confirm_password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insertQuery = $conn->prepare("
                INSERT INTO users (name, surname, student_number, contact, module_code, email, password)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $insertQuery->bind_param("ssissss", $name, $surname, $student_number, $contact, $module_code, $email, $hash);

            if ($insertQuery->execute()) {
                echo "Registeration successful";
                header("Location : index.php");//exit to login page
                exit;
            } else {
                echo "Error: " . $insertQuery->error;
            }
        } else {
            echo "Passwords don't match. Please try again.";
        }
    }

    $checkEmail->close();
}

// signing in logic
if (isset($_POST['signIn'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $query->bind_result($id, $email, $hash);
        $query->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
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
