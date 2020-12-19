<?php 
  // $servername ="localhost";
  // $username   ="root";
  // $password   ="";
  // $db         ="practice";

  // $conn = mysqli_connect($servername,$username,$password,$db);
  // if (!$conn) {
  //   die("Connection failed". mysqli_connect_error());
  // }
  // $result=null;
  // if (isset($_POST['register'])) {

  //    $name      = $_POST['name'];
  //    $phone     = $_POST['phone'];
  //    $email     = $_POST['email'];
  //    $password  = $_POST['password'];

  //   $insert_stmt = "INSERT INTO users(name, phone, email, pass) VALUES ('$name','$phone','$email','$password')";

  //   $run_insert_stmt = mysqli_query($conn,$insert_stmt);

  //   if ($run_insert_stmt) {
  //     $result ="<div class='alert alert-primary' role='alert'>Data insert successfully.</div>";
  //   }
  //   else{
  //      $result ="<div class='alert alert-danger' role='alert'>Problem to insert data.</div>";
  //   }
  // }
  
  $servername ="localhost";
  $username ="root";
  $password="";
  $db ="practice";

  $conn = new mysqli($servername,$username,$password,$db);

  if ($conn -> connect_error) {
    die("connection failed". $conn -> connect_error);
  }

  $result=null;
  if (isset($_POST['register'])) {

    $name      = $_POST['name'];
    $phone     = $_POST['phone'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];

    $ins_stmt = $conn -> prepare("INSERT INTO users(name, phone, email, pass) VALUES (?, ?, ?, ?)");

    $ins_stmt -> bind_param("ssss",$name, $phone,$email,$password);

   

    if ( $ins_stmt -> execute()) {
      $result ="<div class='alert alert-primary' role='alert'>Data insert successfully.</div>";
    }
    else{
      $result ="<div class='alert alert-danger' role='alert'>Problem to insert data.</div>";
    }
  }
  
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Practise</title>
  </head>
  <body>
    <section>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h1 class="text-center my-3">REGISTRATION FORM</h1>
            <form class="row g-3" method="post">
               <?php echo $result; ?>
              <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>

              <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
              </div>

              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>

              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary" name="register" data-bs-toggle="modal" data-bs-target="#view">Register</button>
                <div class="form-text">Already have an account?<a href="login.php">Login here</a></div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h1 class="text-center my-2"> SHOW ALL INFORMATION</h1>
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $show_stmt ="select * from users";

                $run_show = $conn -> query($show_stmt);

                 $count = $run_show-> num_rows;

                if ( $count < 1) {
                  ?>
                  <tr>
                  <td colspan="4">Now Rows Found here.</td>
                </tr>
                  <?php
                }

                  else{

                    while ($row = $run_show -> fetch_assoc()) {
                      ?>
                  <tr>
                  <td class="val"><?php echo $row['name']?></td>
                  <td><?php echo $row['phone']?></td>
                  <td><?php echo $row['email']?></td>
                  <td> 
                      <button type="button" class="btn btn-primary view">
              view
            </button>

                   || 


                   <a href="delete.php?id=<?php echo $row['id'];?>">Delete</a>


                 </td>
                </tr>
                      <?php
                    }
                  }
               

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <!-- modal section -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- Button trigger modal -->
             <!--  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Launch static backdrop modal
              </button> -->

             
             <!-- Button trigger modal -->
            

            <!-- Modal -->
            <div class="modal fade" id="view">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="view_data"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                  </div>
                </div>
              </div>
            </div>




          </div>
        </div>
      </div>
    </section>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>