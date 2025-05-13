<?php
session_start();
if (empty($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}
include 'database.php';

// Fetch user info
$stmt = $conn->prepare("
  SELECT profile_pic
  FROM users WHERE id=?
");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($fn, $ln, $stu, $ct, $mc, $em, $pic);
$stmt->fetch();
$stmt->close();
$conn->close();

// Full name and membership tier
$fullName = htmlspecialchars("$fn $ln");
$tier     = 'Gold member';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome, <?= $fullName ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="style.css" rel="stylesheet">
  <script defer src="script.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="card">
    <div class="profile-top">
      <img class="avatar" src="<?= $pic ?: 'default-avatar.png' ?>" alt="Avatar">
      <h1><?= $fullName ?></h1>
      <p class="tier"><i class="fas fa-bolt"></i> <?= $tier ?></p>
    </div>
    <div class="contact-info">
      <p><i class="fas fa-phone"></i> <?= htmlspecialchars($ct) ?></p>
      <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($em) ?></p>
    </div>
    <div class="menu">
      <label class="toggle">
        <span><i class="fas fa-moon"></i> Dark mode</span>
        <input type="checkbox" id="darkModeToggle">
        <span class="slider"></span>
      </label>
      <a href="#"><i class="far fa-credit-card"></i> Cards</a>
      <a href="#"><i class="fas fa-user-edit"></i> Profile details</a>
      <a href="#"><i class="fas fa-cog"></i> Settings</a>
      <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
    </div>
  </div>
</body>
</html>
