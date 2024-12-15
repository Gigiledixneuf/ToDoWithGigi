<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <h1>Welcome Back</h1>
      <p>Please sign in to continue</p>

      <?php 
      session_start();
      session_destroy();
      session_start();
      $db = new PDO('mysql:host=localhost;dbname=bd_todoapp', 'root', '');

      if (isset($_POST['login'])) {
                                extract($_POST);
          $insertion = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
          $insertion->execute(array($username, $password));
          $checkuser = $insertion->rowCount();
                                
          if ($checkuser == 1) {
              $userinfo = $insertion->fetch();
              if ($userinfo) {
                  $_SESSION['id'] = $userinfo['id'];
                  $_SESSION['username'] = $userinfo['username'];
                  $_SESSION['noms'] = $userinfo['noms'];
                  
                  header("location:loader.html?id=" . $_SESSION['id']);
              }
              } else {
                  echo '<div id="errorMessage" style="color: red; font-weight: bold; font-size:14px; margint: 15px;">';
                  echo "Cet utilisateur n'existe pas";
                  echo "</div>";
              }
          }
          ?>
          <script>
              // Masquer le message d'erreur après 5 secondes
              setTimeout(function() {
                  var errorMessage = document.getElementById('errorMessage');
                  if (errorMessage) {
                                        errorMessage.style.display = 'none'; // Cache l'élément
                  }
              }, 2500); // 5000 ms = 5 secondes
          </script>

      <form class="login-form" method="post">
        <div class="input-group">
          <label for="email">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="login-btn" name="login">Login</button>
        <div class="links">
          <a href="create.php">Create an Account</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
