<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
include 'connect.php';

// Fetch existing user data
$stmt = $conn->prepare("
  SELECT name, surname, student_number, module_code, contact, email, profile_picture
  FROM users
  WHERE id = ?
");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($name, $surname, $student_number, $module_code, $contact, $email, $profile_picture);
$stmt->fetch();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize inputs
    $newName  = trim($_POST['name']);
    $newSurname = trim($_POST['surname']);
    $newStudentNumber = trim($_POST['student_number']);
    $newModuleCode = trim($_POST['module_code']);
    $newContact = trim($_POST['contact']);
    $newEmail = trim($_POST['email']);
    $avatarFilename = $profile_picture;

    // Handle avatar upload if provided
    if (!empty($_FILES['profile_picture']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $tmpName = $_FILES['profile_picture']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $avatarFilename = time() . '_' . uniqid() . '.' . $ext;
            move_uploaded_file($tmpName, $uploadDir . $avatarFilename);
        }
    }

    // Update user record
    $upd = $conn->prepare("
      UPDATE users SET
        name           = ?,
        surname        = ?,
        student_number = ?,
        module_code    = ?,
        contact        = ?,
        email          = ?,
        profile_picture= ?
      WHERE id = ?
    ");
    $upd->bind_param(
        'ssissssi',
        $newName,
        $newSurname,
        $newStudentNumber,
        $newModuleCode,
        $newContact,
        $newEmail,
        $avatarFilename,
        $_SESSION['user_id']
    );
    $upd->execute();
    $upd->close();
    $conn->close();

    // Redirect back to profile
    header('Location: homepage.php');
    exit;
}

$conn->close();

// Fallback avatar
$avatar = $profile_picture ?: 'default-avatar.png';
$fullName = htmlspecialchars("$name $surname");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile — <?= $fullName ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel = "stylesheet" href = "edit-profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
</head>
<body>
  <div class="form-container">
    <h2>Edit Profile</h2>
    <img src="uploads/<?= htmlspecialchars($avatar) ?>" alt="Avatar" class="avatar-preview" id="avatarPreview">
    <form method="post" enctype="multipart/form-data">
      <div class="input-group">
        <i class="fas fa-camera"></i>
        <input type="file" name="profile_picture" id="profilePicInput" accept="image/*">
      </div>
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
      </div>
      <div class="input-group">
        <i class="fas fa-user-tag"></i>
        <input type="text" name="surname" value="<?= htmlspecialchars($surname) ?>" required>
      </div>
      <div class="input-group">
        <i class="fas fa-id-card"></i>
        <input type="text" name="student_number" value="<?= htmlspecialchars($student_number) ?>" required>
      </div>
      <div class="input-group">
        <i class="fas fa-book"></i>
        <input type="text" name="module_code" value="<?= htmlspecialchars($module_code) ?>" required>
      </div>
      <div class="input-group">
        <i class="fas fa-phone"></i>
        <input type="tel" name="contact" value="<?= htmlspecialchars($contact) ?>" required>
      </div>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
      </div>
      <button type="submit" class="submit-btn">Save Changes</button>
    </form>
    <a href="homepage.php" class="back-link">← Back to Profile</a>
  </div>

<script>
  // Live avatar preview
  document.getElementById('profilePicInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = evt => {
      document.getElementById('avatarPreview').src = evt.target.result;
    };
    reader.readAsDataURL(file);
  });
</script>
</body>
</html>
