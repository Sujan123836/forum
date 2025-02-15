<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iforums</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <?php include 'partials/navbar.php';?>
    
    <?php include 'partials/dbconnect.php';?>
    <?php include 'partials/carousel.php';?>

    <div class="container my-3">
      <h2 align="center">IDiscuss:- Categories</h2>
      <div class="row">
      <?php
      $sql = "SELECT * FROM `category`";
      $result = mysqli_query($conn, $sql);
      
       if (mysqli_num_rows($result) > 0) {
        
       // output data of each row
       while($row = mysqli_fetch_assoc($result)) {
        $id=$row["category_id"];
        $title=$row["category_name"];
        $desc=substr($row["category_desc"],0,50);
        echo ' <div class="col-md-4 my-2">
            <div class="card" style="width: 18rem">
              <img src="picture/eeee2.jpg" class="card-img-top" alt="anything" />
              <div class="card-body">
                <h5 class="card-title">'.$title.'</h5>
                <p class="card-text">
                  '.$desc.'........'.'
                </p>
                <a href="threadlist.php?id='.$id.'" class="btn btn-primary">View Threads</a>
              </div>
            </div>
          </div>';

       }
       }
       
       mysqli_close($conn);
       ?>
       </div>
      
    </div>
    <?php include 'partials/footer.php';?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>