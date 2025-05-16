<?php
session_start();
include 'connect.php';

if (empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("
    SELECT id, name, surname, student_number, module_code, contact, email, profile_picture
    FROM users
    WHERE id = ?
");

$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($id, $name, $surname, $student_number, $module_code, $contact, $email, $profile_picture);
$stmt->fetch();
$stmt->close();
$conn->close();

// Fallback avatar if none uploaded
$avatar = $profile_picture ?: 'default-avatar.png';
$fullName = htmlspecialchars("$name $surname");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
    <link rel="stylesheet" href="homepage.css">
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="main-profile">
                    <div class="profile-image" style="background-image: url('uploads/<?= htmlspecialchars($avatar) ?>');"></div>
                    <div class="profile-names">
                        <h1 class="username">Hello,<?= $fullName ?></h1>
                        <small class="page-title">Student</small>
                    </div>
                </div>
            </div>
            <div class="profile-body">
                <div class="profile-actions">
                    <a href="edit-profile.php" class="btn follow"><i class="fas fa-user-edit"></i> Edit Profile</a>
                    <a href="logout.php" class="btn message"><i class="fas fa-sign-out-alt"></i> Logout</a>
        
                </div>
                <div class="account-info">
                    <div class="data">
                        <div class="important-data">
                            <section class="data-item">
                                <h3 class="value"><?= htmlspecialchars($student_number) ?></h3>
                                <small class="title">Student Number</small>
                            </section>
                            <section class="data-item">
                                <h3 class="value"><?= htmlspecialchars($module_code) ?></h3>
                                <small class="title">Module Code</small>
                            </section>
                            <section class="data-item">
                                <h3 class="value"><?= htmlspecialchars($contact) ?></h3>
                                <small class="title">Contact</small>
                            </section>
                        </div>
                        <div class="other-data">
                            <section class="data-item">
                                <h3 class="value"><?= htmlspecialchars($email) ?></h3>
                                <small class="title">Email</small>
                            </section>
                            <!-- Add more data items as needed -->
                        </div>
                    </div>
                    <!-- Social media links can be added here if available -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>
