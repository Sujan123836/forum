<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to threads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      #fixed{
        min-height: 500px;
      }
    </style>
  </head>
  <body>
  <?php include 'partials/navbar.php';?>
  <?php include 'partials/dbconnect.php';?>
  <?php
  if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `category` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
  
   if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $name=  $row["category_name"];
      $description=$row["category_desc"];
      echo '<div class="container my-3">
  <div class="jumbotron mx-auto">
  <h1 class="display-4 text-center">'.$name.'</h1>
  <p class="lead">'.$description.'</p>
</div>
  </div>';
   }
   }
   
  }
  ?>
  <div class="container" id="fixed">
  <div class="media">
  <h5 class="mt-2 text-center"> Browse Questions??</h5>
  <?php
  if (isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "SELECT * FROM `threadlist` WHERE thread_category_id=$id ";
  $result = mysqli_query($conn, $sql);
  $question=true;   
  if (mysqli_num_rows($result) > 0) {
        
       // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $catsid=$row["thread_id"];
    $name=  $row["thread_category"];
    $description=$row["thread_description"];
    $question=false;
    $symbol=":-----";

    //Any QUestions section 
   echo '<div class="media-body">
   <div class="container">
      <div class="d-flex align-items-center">
          
          <!-- Image -->
          <img src="picture/user.jpg"  width="60" class="me-3" alt="...">
          <!-- Paragraph -->
          <p class="mb-0 fw-bold"><a href="thread.php?id='.$catsid.'" class="text-black">'.$name.'</a>'.$symbol.'</p>
          <p class="mb-0">'.$description.'</p>
      </div>
  </div>
      
</div>';
  }
  }
  if($question){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>No Questions Yet!</strong> Please ask Questions if you have one . Be the first !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
}
?>
<!-- for posting threads and description -->
 <?php
if (isset($_GET['id'])){
  $id = $_GET['id'];
  ?>
<form action="threadlist.php" method="POST">
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Thread Title</label>
  <input type="text" class="form-control" id="title"  name="title">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Thread Description</label>
  <textarea class="form-control my-2" id="desc" name="desc" rows="3"></textarea>
  <input type="hidden" name="category_id" value="<?php echo $id; ?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
<?php
}
?>
 </div>
  </div>
  <!--form handling  -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get and sanitize form data
  $title = $_POST['title'];
  $desc = $_POST['desc'];
  $category_id = (int)$_POST['category_id'];
  $userid=0;
  $sql = "INSERT INTO `threadlist`(`thread_category`, `thread_description`, `thread_category_id`, `thread_user_id`) VALUES ('$title','$desc','$category_id','$userid')";
  
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  }
}
mysqli_close($conn);
?>

<?php include 'partials/footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>