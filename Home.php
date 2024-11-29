<?php
session_start(); // Start the session
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medical System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="home_style.css">
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
 
    <div class="card_log">
      <?php
      if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']); // Fixed password retrieval
        
        $result = mysqli_query($con, "SELECT * FROM register WHERE Email='$email' AND Password='$password'")
        or die("Select Error"); 

        $row = mysqli_fetch_assoc($result);
        
        if (is_array($row) && !empty($row)) {
          $_SESSION['valid'] = $row['Email'];
          $_SESSION['username'] = $row['Username']; 
          $_SESSION['age'] = $row['Age'];
          $_SESSION['id'] = $row['Id'];

          header("Location: Search.php");
          exit(); // Always exit after a redirect
        } else {
          echo "<div class='message alert alert-danger'>
                  <p>Wrong Email or Password</p>
                </div>";
          echo "<a href='home.php'><button class='btn'>Go Back</button></a>";
        }
      }
      ?>

      <h2>Login</h2>
      <form method="POST" action=""> <!-- Added method and action -->
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="submit" class="btn">Login</button> <!-- Corrected button placement -->
        <div class="links">
          Don't have an account? <a href="Register.php">Sign up now!</a>  
        </div>
      </form>
     
    </div>
  </div>
  
  <!-- intro -->
  <section class="intro-part">
    <div class="header-of-intro">
      <h1>Start a Machine Learning Based Medical Journey</h1>
      <p>Our website provides you the best experience of the medical world that is trustworthy and efficient.</p>
      <div>
        <a href="#" target="_blank" class="contract_home">Contact Us<i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
    <div class="img-part">
      <img src="hospital-clinic-building-3d-icon-illustration-png.webp" alt="a picture of a hospital">
    </div>
  </section>
</body>
</html>
