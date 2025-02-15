<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php include 'dbconnect.php'; ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  $cpassword = htmlspecialchars($_POST['cpassword']);
  $resempty = (empty($username) || empty($password) || empty($cpassword));
  $errormsg = "";
  $successmsg = "";

  // Validate form inputs
  if ($resempty) {
    $errormsg = "All fields are required.";
  } elseif ($password !== $cpassword) {
    $errormsg = "Passwords do not match.";
  } else {
    // Check for duplicate username
    $sql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      $errormsg = "Username already exists.";
    } else {
      // Hash the password
      $hpassword = password_hash($password, PASSWORD_DEFAULT);

      // Insert new user into the database
      $sql2 = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$hpassword')";
      if (mysqli_query($conn, $sql2)) {
        $successmsg = "You can now log in!";
        header('Location: http://localhost/iforums/index.php?successmsg=true');
        exit;
      } else {
        $errormsg = "Database error. Please try again.";
      }
    }
  }

  // Redirect with error message if there are errors
  if (!empty($errormsg)) {
    header('Location: http://localhost/iforums/index.php?errormsg=' . urlencode($errormsg));
    exit;
  }
}

?>
</body>
</html>