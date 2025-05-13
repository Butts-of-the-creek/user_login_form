<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fname'];
    $lastName=$_POST['lName'];
    $student_number = $_POST['student_number'];
    $contact = $_POST['contact'];
    $module_code = $_POST['module_code'];
    $email = $_POST['emali'];
    $password=$_POST['password'];
    $confirm_password = $_POST['confirm_password'];

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
    
     if($result->num_rows>0){
        echo "Email exists! Use another";
     }
     else{
        
    if( $password === $confirm_password){

        $hash = mdt5($password);
        $insertQuery="INSERT INTO users(name,surname,
        student_no,contact, module_code ,email,password)
        VALUES ('$firstName','$lastName','$student_number',
        '$contact','$email','$hash')";
        if($conn->query($insertQuery)==TRUE){
        header("location: index.php");
        }
        else{
        echo "Error:".$conn->error;
        }
    }
   
}

}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    header("Location: homepage.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>