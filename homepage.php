<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
include 'connect.php';

// Fetch user info
$stmt = $conn->prepare("
    SELECT profile_pic
    FROM users WHERE id=?
");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($profilePic);
$stmt->fetch();
$stmt->close();
$conn->close();

$fullName = htmlspecialchars("$firstName $lastName");
$profilePic = $profilePic ?: 'default-avatar.png';
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
            <img src="<?= $profilePic ?>" alt="Avatar" class="avatar">
            <h2><?= $fullName ?></h2>
            <p><i class="fas fa-id-card"></i> Student Number: <?= htmlspecialchars($studentNumber) ?></p>
            <p><i class="fas fa-list"></i> Module Code: <?= htmlspecialchars($moduleCode) ?></p>
            <p><i class="fas fa-envelope"></i> Email: <?= htmlspecialchars($email) ?></p>
            <p><i class="fas fa-phone"></i> Contact: <?= htmlspecialchars($contactNumber) ?></p>
        </div>
        <div class="menu">
            <a href="edit-profile.php" class="btn"><i class="fas fa-user-edit"></i> Edit Profile</a>
            <a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
    </div>
</body>
</html>
