<?php 
session_start();
include 'connect.php';
require_once("db_con.php");

 // user
if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)
                       VALUES ('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
    

   
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    $_SESSION['user_id']=$row['Id'];
    header("Location: USERmainpage.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }
}



// admin
if(isset($_POST['signInAdmin'])){
    $email=$_POST['emailAdmin'];
    $password=$_POST['passwordAdmin'];

    
    
    $sql="SELECT * FROM admins WHERE email='$email' and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
     $row=$result->fetch_assoc();
     $_SESSION['email']=$row['email'];
     $_SESSION['admin_id']=$row['Id'];
     header("Location: adminmainpage.php");
     exit();
    }
    else{
     echo "Not Found, Incorrect Email or Password";
    }
 
 }
 if(isset($_POST['signUpAdmin'])){
    $firstName=$_POST['fNameAdmin'];
    $lastName=$_POST['lNameAdmin'];
    $email=$_POST['emailAdmin'];
    $password=$_POST['passwordAdmin'];
    $code=$_POST['AdminCode'];

     $checkEmail="SELECT * From admins where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO admins(firstName,lastName,email,password,admincode)
                       VALUES ('$firstName','$lastName','$email','$password','$code')";
            if($conn->query($insertQuery)==TRUE){
                header("location: adminmainpage.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}



?>