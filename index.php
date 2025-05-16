<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Portal - Register & Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>

<!-- SIGNUP FORM -->
<div class="container" id="signup" style = "display: none;">
  <h1 class="form-title">Register</h1>
  <form method="POST" action="register.php">
    <div class="input-group">
      <i class="fas fa-user"></i>
      <input type="text" name="name" id="name" placeholder="Name" required>
      <label for="name">Name</label>
    </div>
    <div class="input-group">
      <i class="fas fa-user"></i>
      <input type="text" name="surname" id="surname" placeholder="Surname" required>
      <label for="surname">Surname</label>
    </div>
    <div class="input-group">
      <i class="fas fa-credit-card"></i>
      <input type="text" name="student_number" id="student_number" placeholder="Student Number" required>
      <label for="student_number">Student Number</label>
    </div>
    <div class="input-group">
      <i class="fas fa-list"></i>
      <input type="text" name="module_code" id="module_code" placeholder="Module Code" required>
      <label for="module_code">Module Code</label>
    </div>
    <div class="input-group">
      <i class="fas fa-envelope"></i>
      <input type="email" name="email" id="email" placeholder="Email" required>
      <label for="email">Email</label>
    </div>
    <div class="input-group">
      <i class="fas fa-phone"></i>
      <input type="tel" name="contact" id="contact" placeholder="Phone Number" required>
      <label for="contact">Phone Number</label>
    </div> 
    <div class="input-group">
      <i class="fas fa-lock"></i>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <label for="password">Password</label>
    </div>
    <div class="input-group">
      <i class="fas fa-lock"></i>
      <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
      <label for="confirm_password">Confirm Password</label>
    </div>
    <input type="submit" class="btn" value="Sign Up" name="signUp">
  </form>
  <p class="or">OR</p>
  <div class="icons">
    <i class="fab fa-google"></i>
    <i class="fab fa-apple"></i>
    <i class="fab fa-twitter"></i>
  </div>
  <div class="links">
    <p>Already registered?</p>
    <button id="signInButton">Sign In</button>
  </div>
</div>

<!-- 🔐 SIGN IN FORM -->
<div class="container" style = "display: block" id="signInContainer">
  <h1 class="form-title">Sign In</h1>
  <form method="POST" action="register.php">
    <div class="input-group">
      <i class="fas fa-envelope"></i>
      <input type="email" name="loginmail" id="loginmail" placeholder="Email" required>
      <label for="emailLogin">Email</label>
    </div>
    <div class="input-group">
      <i class="fas fa-lock"></i>
      <input type="password" name="loginpass" id="loginpass" 
      placeholder="Password" required>
      <label for="login password">Password</label>
    </div>
    <p class="recover"><a href="#">Recover Password</a></p>
    <input type="submit" class="btn" value="Sign In" name="signIn">
  </form>
  <p class="or">OR</p>
  <div class="icons">
    <i class="fab fa-google"></i>
    <i class="fab fa-apple"></i>
    <i class="fab fa-twitter"></i>
  </div>
  <div class="links">
    <p>No account?</p>
    <button id="signUpButton2">Sign Up Here</button>
  </div>
</div>

<footer>
  <div style="color: white;" class="footer" id="footer_content">
    Made by 202359509
  </div>
</footer>
<script src = "script.js"></script>
</body>
</html>
