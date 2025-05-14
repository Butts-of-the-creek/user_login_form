<?php
session_start();
include 'connect.php';

// Fetch user info
$stmt = $conn->prepare(" SELECT profile_pic FROM users WHERE id=?");
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($profilePic);
$stmt->fetch();

$stmt->close();
$conn->close();

$fullName = htmlspecialchars("$name $surname");
$profile_picture = $profile_picture ?: 'default-avatar.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Welcome, <?= $fullName ?></title>
    <link href="homepage.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header">
            <h1>Welcome, <?= $fullName ?></h1>
        </div>
    </header>
    <div class="profile-container">
        <div class="profile-card">
            <img src="<?= $profile_picture ?>" alt="Avatar" class="avatar">
            <h2><?= $fullName ?></h2>
            <p><i class="fas fa-id-card"></i> Student Number: <?= htmlspecialchars($student_number) ?></p>
            <p><Module Code: <?= htmlspecialchars($module_code) ?></p>
            <p>< Email: <?= htmlspecialchars($email) ?></p>
            <p>Contact: <?= htmlspecialchars($contact) ?></p>
        </div>
        <div class="menu">
            <a href="edit-profile.php" class="btn"><i class="fas fa-user-edit"></i> Edit Profile</a>
            <a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
    </div>
</body>
</html>
