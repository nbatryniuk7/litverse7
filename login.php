<?php 
session_start();

// Видаляємо старі сесії, щоб уникнути зациклення
if (!isset($_SESSION['logged_in'])) {
  session_destroy();
  session_start();
}

include 'server/connection.php';

if (!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  header('location: account.php');
  exit();
}

$error = '';

if (isset($_POST['login_btn'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare('SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? LIMIT 1');
  $stmt->bind_param('s', $email);

  if ($stmt->execute()) {
    $stmt->bind_result($user_id, $user_name, $user_email, $hashed_password);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
      $stmt->fetch();
      
      if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['logged_in'] = true;

        header('location: account.php');
        exit();
      } else {
        $error = "Invalid email or password";
      }
    } else {
      $error = "User not found";
    }
  } else {
    $error = "Database error";
  }
}
?>


<?php include"layouts/header.php"; ?>

      <!--Login-->
      <section class = "my-5 py-5">
        <div class = "container text-center mt-3 pt-5">
            <h2 class = "form-weight-bold">Login</h2>
            <hr class = "mx-auto">
        </div>
        <div class = "mx-auto container">
            <form id = "login-form" method="POST" action="login.php">
              <p style="color: red" class="text-center"><?php if(!empty($error)) { echo "$error"; }  ?></p>
                <div class = "form-group">
                    <label>Email</label>
                    <input type="email" class = "form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class = "form-group">
                    <label>Password</label>
                    <input type="password" class = "form-control" id="login-password" name="password" placeholder="Password" required>
                </div>
                <div class = "form-group">
                    <input type="submit" class = "btn" id="login-btn" name="login_btn" value="Login">
                </div>
                <div class = "form-group">
                    <a id="register-url" class = "btn" href="register.php">Don't have account? Register</a>
                </div>

            </form>
        </div>
      </section>
    

      <?php include"layouts/footer.php"; ?>