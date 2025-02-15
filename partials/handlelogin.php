<?php include 'dbconnect.php';?>
<?php session_start(); ?> // Start session at the beginning
<?php

  if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['psw']);
    $sql="SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $rowno=mysqli_num_rows($result);
    $loginsuccess=false;

      if ($rowno == 1) {
        while($row=mysqli_fetch_assoc($result)){
          if (password_verify($password, $row['password'])){
            $loginsuccess=true;
            $_SESSION["loggedIn"]=true; 
            $_SESSION["username"]=$username;
            header('Location: http://localhost/iforums/index.php?loginsuccess=true');
            exit;
              } 
        }
        
      }
      
        $loginerror=true;
        header('Location: http://localhost/iforums/index.php?loginerror=true');
        exit;
      

       mysqli_close($conn);
    
  }
?>
