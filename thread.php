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
    $sql = "SELECT * FROM `threadlist` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
  
   if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $name=  $row["thread_category"];
      $description=$row["thread_description"];
   }
   } 
   echo '<div class="container my-3">
   <div class="alert alert-success" role="alert">
   <h4 class="alert-heading">'.$name.'</h4>
   <p>'.$description.'</p>
   <hr>
   <p class="mb-0">Posted By Sujan</p>
   </div>
   </div>';
  }
  ?>
  <!-- for displaying thread name and descripton on the basis of thread id -->


  
  
  <div class="container" id="fixed">
  <h4>Discussions</h4>
  <?php
  if (isset($_GET['id'])){
    $id = $_GET['id'];
 
  ?>
  <form action="thread.php" method="POST">
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Your Comment!</label>
  <textarea class="form-control my-2" id="desc" name="desc" rows="3"></textarea>
  <input type="hidden" name="category_id" value="<?php echo $id; ?>">
  <button type="submit" class="btn btn-primary">Post Comment!</button>
</div>
</form>
<?php
 }
?>
  
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get and sanitize form data
  $desc = $_POST['desc'];
  $category_id = (int)$_POST['category_id'];
  $userid=0;
  $sql = "INSERT INTO `comment` ( `comment_content`, `threadcategory_id`, `comment_by`) VALUES ( '$desc','$category_id',$userid)";
  
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  }
}
?>
<?php
if (isset($_GET['id'])){
$id = $_GET['id'];
$sql = "SELECT * FROM `comment` WHERE `threadcategory_id`=$id";
$result = mysqli_query($conn, $sql);
$user="Anonymous User";     
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
$content=$row['comment_content'];
 echo '<div class="media-body">
   <div class="container">
      <div class="d-flex align-items-center">
          
          <!-- Image -->
          <img src="picture/user.jpg"  width="60" class="me-3" alt="...">
          <!-- Paragraph -->
          <p class="mb-0 fw-bold text-black">'.$user .'</p>
          <p class="mb-0">'.$content.'</p>
      </div>
  </div>
      
</div>';

}
}
}
mysqli_close($conn);

?>
</div>

<?php include 'partials/footer.php';?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>