<?php 
  // $servername ="localhost";
  // $username   ="root";
  // $password   ="";
  // $db         ="practice";

  //  $conn = mysqli_connect($servername,$username,$password,$db);
  // if (!$conn) {
  //   die("Connection failed". mysqli_connect_error());
  // }
  // $result=null;

  //  if (isset($_POST['login'])) {
      

  //     $mail=$_POST['email'];
  //     $pass=$_POST['password'];



  //   $sql ="select * from users where email ='$mail' AND pass='$pass'";

  //   $run=mysqli_query($conn,$sql);
  //   $count = mysqli_num_rows($run);

  //   if ($count>0) {
  //     header('location:main.php');
  //   }
  //   else{
  //     $result ="<div class='alert alert-danger' role='alert'>Username and password invalid.</div>";
  //   }
  // }


// oop using for 

  $servername ="localhost";
  $username ="root";
  $password="";
  $db ="practice";

  $conn = new mysqli($servername,$username,$password,$db);

  if ($conn -> connect_error) {
    die("connection failed". $conn -> connect_error);
  }
  $result =null;

  if (isset($_POST['login'])) {
    $mail=$_POST['email'];
    $pass=$_POST['password'];

    $login_stmt = $conn -> prepare("select * from users where email= ? AND pass= ?");

    $login_stmt ->bind_param("ss", $mail, $pass);

    $login_stmt -> execute();

    $result = $login_stmt -> get_result();

    $count = $result-> num_rows;

    if ($count >0) {
      header("location:main.php");
    }
    else{
      $result ="<div class='alert alert-danger' role='alert'>Username and password invalid.</div>";
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
    <title>Hello, world!</title>
  </head>
  <body>
    
    <section>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
              <h1 class="text-center my-3">Login form</h1>
            <form method="post">
              <?php echo $result; ?>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div>
              <button type="submit" class="btn btn-primary" name="login">login</button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
