<?php session_start(); ?>
<?php include 'partials/loginmodal.php';?>
<?php include 'partials/signupmodal.php';?>
<?php  
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#">IForum</a>
  <button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"             
    data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="aboutus.php">About Us</a>
      </li>
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          Categories
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contactus.php">Contact Us</a>
      </li>
    </ul>

    <form class="d-flex" role="search" style="width: 342px; height: 40px;">
      <input
        class="form-control me-2"
        type="search"
        placeholder="Search"
        aria-label="Search"
      />
      <button class="btn btn-outline-light" type="submit">Search</button>';
      if(isset($_SESSION["loggedIn"]) && ($_SESSION["loggedIn"])==true){
       echo' <p class="text-white"> welcome, '.$_SESSION['username'].'</p>
       <a href="/iforums/partials/logout.php" class="text-white" >Logout</a>';
      } 
      else{
        echo '<button type="button" class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>
      <button type="button" class="btn btn-dark" type="submit" data-bs-toggle="modal" 
      data-bs-target="#exampleModal2">SignUp</button>
    </form>';
      }
      
    
  echo '</div>
</div>

</nav>';
?>

<?php
if(isset($_GET['successmsg'])){
  echo'<div class="alert alert-success my-0" role="alert">
  Suceess ! you can now login in
  </div>';
}
if(isset($_GET['errormsg'])){
  echo'<div class="alert alert-success my-0" role="alert">
  '.htmlspecialchars($_GET['errormsg']).'
  </div>';
}
if(isset($_GET['loginsuccess'])){
  echo'<div class="alert alert-success my-0" role="alert">
  you are logged in
  </div>';
}
if(isset($_GET['loginerror'])){
  echo'<div class="alert alert-danger my-0" role="alert">
Password Error!!
  </div>';
}

?>



