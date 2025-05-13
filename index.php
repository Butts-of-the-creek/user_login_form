<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<header>
  <div class = "header"
  id = "header" name = "header" >
  <div class = "header_element"  id = "menu">
     <h1></h1>
  </div>
  <hr>
</header>
<body>
    <div class="container" id="signup" style="display:none;">
      <h1 class="form-title">Register</h1>
      <form method="post">

      <input type="hidden" name="action" value="signin">
        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="fName" id="fName" placeholder="First Name" required>
           <label for="fname">First Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-credit-card"></i>
            <input type="number" name="student_number" id="student_number"
             placeholder="student_number" required>
            <label for="student_number" min ="10" >Student number</label>
        </div>
        <div class="input-group">
            <i class="fas fa-list"></i>
            <input type="text" name="module_code"
             id="module_code" placeholder="module_code"
              required>
            <label for="module_code">module code</label>
        </div>
        <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required>
              <label for="email">Email</label>
          </div>
        <div class="input-group">
            <i class="fas fa-phone"></i>
            <input type="number" name="contact_number" id="email" placeholder="Email" required>
            <label for="phome">phone number</label>
        </div> 
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="confirm_password"
             id="confirm_password" placeholder="Password" required>
            <label for="confirm_password">Confirm Password</label>
        </div>
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      <p class="or">
        OR
      </p>
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

    <div class="container" id="signIn">
        <h1 class="form-title">Sign Back In</h1>
        <form method="post">

        <input type="hidden" name="action" value="signin">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required>
              <label for="email">Email</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required>
              <label for="password">Password</label>
          </div>
          <p class="recover">
            <a href="https://itschai.com">Recover Password</a>
          </p>
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">
         OR
        </p>
        <div class="icons">
          <i class="fab fa-google"></i>
          <i class="fab fa-apple"></i>
          <i class="fab fa-twitter"></i>
        </div>
        <div class="links">
          <p>No account?</p>
          <button id="signUpButton">Sign Up Here</button>
        </div>
      </div>
      <script src="script.js"></script>
</body>
<icon>
<footer>

<div class = "footer" id = "footer_content">

<div class="input-group">
            <i class="fas fa-lock"></i>

</div>

</footer>
</html>
