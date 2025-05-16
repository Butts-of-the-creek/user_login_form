document.getElementById('signUpButton2').onclick = () => {
    document.getElementById('signInContainer').style.display = 'none';
    document.getElementById('signup').style.display = 'block';
  }; 
document.getElementById('signInButton').onclick = () => {
    document.getElementById('signup').style.display = 'none';
    document.getElementById('signInContainer').style.display = 'block';
  };
 
  
  // Inline JavaScript for profile image preview and logout
  document.addEventListener('DOMContentLoaded', () => {
    const changePicBtn = document.getElementById('changePicBtn');
    const picInput = document.getElementById('picInput');
    const profileImage = document.getElementById('profileImage');
    const logoutBtn = document.getElementById('logoutBtn');

    // Trigger file input when "Change Photo" button is clicked
    changePicBtn.addEventListener('click', () => picInput.click());

    // Preview selected image immediately
    picInput.addEventListener('change', e => {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = ev => profileImage.style.backgroundImage = `url('${ev.target.result}')`;
      reader.readAsDataURL(file);
    });

    // Logout: clear session and redirect
    logoutBtn.addEventListener('click', () => {
      // In a real app, you'd call a PHP logout endpoint here
      window.location.href = 'logout.php';
    });
  });
