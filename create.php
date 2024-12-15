<!-- connexion à la base de données -->
<?php 
include ('bd/connexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <link rel="stylesheet" href="css/create.css">
  <link rel="icon" type="image/png" sizes="32x32" href="img/logo/logo2.PNG">
</head>
<body>
  <div class="signup-container">
    <div class="signup-box">
      <h1>Create Account</h1>
      <p>Join us and start managing your tasks!</p>
      <script src="js/animation.js"></script>

      <?php 
      if (isset($_POST['create'])) {
        extract($_POST);
        $dates = date('Y-m-d');

        // Vérification si le produit existe déjà par nom
        $onvaverifierusername = $db->prepare("SELECT id FROM users WHERE username = ?");
        $onvaverifierusername->execute(array($username));

        if ($onvaverifierusername->rowCount() > 0) {
            // Le produit existe déjà par nom
            echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'This username is not valid.',
                    text: 'Try again.',
                    showConfirmButton: true
                            });
            </script>";
        }
        else {

        $insertion = $db -> prepare("INSERT INTO users(noms, username, password, date_ajout) VALUES (?, ?, ?, ?)");
        $insertion -> execute (array ($noms, $username, $password, $dates));

         echo "<script>
              Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Account created successfully.',
              showConfirmButton: false,
              timer: 3500
              });
              setInterval(function () {
              window.location.replace('login.php');
              }, 3500);
              </script>";
            }
       }

       ?>
      <form class="signup-form" method="post">
        <div class="input-group">
          <label for="username">Full name</label>
          <input type="text" id="noms" name="noms" placeholder="Enter your full name" required>
        </div>
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>

        </div>
        <div class="input-group">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
          <small id="error" style="color: red; display: none;">Passwords do not match</small>
        </div>
        <button type="submit" class="signup-btn" name="create">Create Account</button>
        <div class="links">
          <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
      </form>
    </div>
  </div>
  <script>

  // Récupérer les éléments du DOM
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirm-password");
  const error = document.getElementById("error");

  // Ajouter un écouteur d'événement sur la saisie du champ de confirmation
  confirmPassword.addEventListener("input", () => {
    if (confirmPassword.value !== password.value) {
      // Afficher le message d'erreur si les mots de passe ne correspondent pas
      error.style.display = "block";
    } else {
      // Cacher le message d'erreur si les mots de passe correspondent
      error.style.display = "none";
    }
  });
</script>

</body>
</html>
