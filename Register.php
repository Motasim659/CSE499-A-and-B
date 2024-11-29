<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medical System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Register.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body> 
<header>
    <!-- navbar -->
    <nav>
      <ul>
        <li class="name"><img src="Logo.png.png" alt="" width="9%"> Medi Support</li>
      </ul>
    </nav>
    <!-- navbar end -->
  </header> 
  <div class="container">
  <?php
        include("config.php");
        if (isset($_POST['submit'])) {
          $username = mysqli_real_escape_string($con, $_POST['username']);
          $email = mysqli_real_escape_string($con, $_POST['email']);
          $age = (int)$_POST['age'];
          $password = mysqli_real_escape_string($con, $_POST['password']);

          $verify_query = mysqli_query($con, "SELECT Email FROM register WHERE Email='$email'");
          if (mysqli_num_rows($verify_query) != 0) {
            echo "<div class='message alert alert-danger'>
                    <p>This email is already in use. Try another one, please!</p>
                  </div>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
          } else {
            mysqli_query($con, "INSERT INTO register (Username, Email, Age, Password) VALUES ('$username', '$email', '$age', '$password')") 
            or die("Error Occurred");
             echo "<div class='message alert alert-success'>
            <p>Registration Successful!</p>
            <a href='Search.php'><button class='btn'>Login now</button></a>
          </div>";
            echo "<script>setTimeout(function() { window.location.href = 'Search.php'; }, 2000);</script>";
          }
        }
      ?>
    <div class="card_log">
      <h2>Sign Up</h2>
      <form method="POST" action="">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="age">Age:</label>
          <input type="number" id="age" name="age" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" class="btn" name="submit" value="Sign Up">
        <div class="link">
          Already have an account? <a href="Home.php">Sign in!</a>  
        </div>
      </form>
    </div>
  </div>
</body>
</html>
