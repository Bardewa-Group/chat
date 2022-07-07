<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header('Location: users.php');
}
?>
<?php include_once "header.php";?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header class="center">Bardewa Group</header>
      <form action="#" method="POST" autocomplete="off">
        <div class="error-text">this is error message</div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="javaScript/pass-show-hide.js"></script>
  <script src="javaScript/login.js"></script>

</body>
</html>
