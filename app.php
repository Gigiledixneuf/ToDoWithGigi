<?php 
include('bd/connexion.php');

// Session, login ou connexion utilisateur
session_start();

$id = $_SESSION['id'];
$username = $_SESSION['username'];
$noms = $_SESSION['noms'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  
<body>
  <style>
   /*   Autre style  */
    ul img{
      width: 35px;
      height: 35px;
    }
    .times{
      background-color: #7f5af0;
      color: #fff;
      padding: 1px 10px; 
      border-radius: 10px; 
      text-align: center;
    }
    .times p{
      margin-top: 15px; 
      font-size: 14px;
    }

  </style>
  <!-- Navbar (Hors de todo-app) -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="app.php">ToDoWhithGigi  😎  </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><?php echo $noms; ?></a></li>
              <li><a class="dropdown-item" href="#" >You have 
              <?php 
              $requette = mysqli_query($connexion, "SELECT count(id) as nbr FROM add_ask WHERE etat = 0 AND username = '$username'");
              while ($garde=mysqli_fetch_assoc($requette)) {
                 echo $garde['nbr'];
               } ?> 
               task(s) to do</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="index.html">Logout</a></li>
            </ul>
          </li>
              <a href="https://github.com/guerchom" target="_blank"><img src="img/icons/icons8-github-logo-94.png"></a>
              <a href="https://www.linkedin.com/in/gigi-kubaluka-686484337/" target="_blank"><img src="img/icons/icons8-linkedin-logo-94.png"></a>
        </ul>
              <div class="times">
                <p>
                    <?php 
                    echo date('d - m - Y');
                    echo " - ";
                    echo date('H:i'); 
                    ?>
                </p>
              </div>     
      </div>
    </div>
  </nav>
  <br>
  <br>

  <!-- Application To-Do -->
  <div class="todo-app">
    <header>
      <h1>ToDO App</h1>
    </header>
    <main>
    <script src="js/animation.js"></script>
      <!--  Ajouter une tache -->
      <?php 
      if (isset($_POST['add'])) {
        extract($_POST);

        $insertion = $db -> prepare("INSERT INTO add_ask(to_do, username) VALUES (?, ?)");
        $insertion -> execute (array ($to_do, $username));

        echo "<script>
              Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Task add successfully. 😃',
              showConfirmButton: false,
              timer: 3500
              });
              setInterval(function () {
              window.location.replace('app.php');
              }, 1000);
              </script>";
      }

      ?>
      <!-- Fin de l'ajout -->
      <form class="task-input" method="post">
        <input type="text" name="to_do" placeholder="Add a new task" required>
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <button class="add-btn" name="add">+</button>
      </form>
      <div class="tasks-container">
        <div class="tasks-section">
          <!-- Comptage de tache à faire -->
          <h2>Task(s) to do - 
              <?php 
              $requette = mysqli_query($connexion, "SELECT count(id) as nbr FROM add_ask WHERE etat = 0 AND username = '$username'");
              while ($garde=mysqli_fetch_assoc($requette)) {
                 echo $garde['nbr'];
               } ?>
               <!-- Fin -->
          </h2>
          <ul class="task-list">
            <!-- Script valider, supprimer et affichage -->
            <?php 
            // Validation
           if (isset($_GET['valide'])) {
             $id = intval($_GET['valide']);
             $requettevalide = mysqli_query($connexion, "UPDATE add_ask SET etat = 1 WHERE id = '$id'");
             echo "<script>
              Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Task completed.🥳',
              showConfirmButton: false,
              timer: 3500
              });
              setInterval(function () {
              window.location.replace('app.php');
              }, 1000);
              </script>";
            }

            // Suppression
            if (isset($_GET['delete'])) {
             $id = intval($_GET['delete']);
             $requettevalide = mysqli_query($connexion, "DELETE FROM add_ask  WHERE id = '$id'");
             echo "<script>
              Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Task deleted.🗑️',
              showConfirmButton: false,
              timer: 3500
              });
              setInterval(function () {
              window.location.replace('app.php');
              }, 1000);
              </script>";
             }

             // Affichage
             $req=mysqli_query($connexion, "SELECT * FROM  add_ask WHERE etat = 0 AND username ='$username' ORDER BY id DESC");
             while ($garde=mysqli_fetch_assoc($req)) { ?>
            <li>
              <span class="task-name"><?php echo $garde['to_do']; ?></span>
              <div class="task-actions">

                <button class="check-btn">
                    <a href="app.php?valide=<?php echo $garde['id']; ?>" style="text-decoration: none; color: inherit;">✔️</a>
                </button>
                <button type="button" 
                        data-bs-toggle="modal"  
                        data-idss="<?php echo $garde['id']; ?>" 
                        data-to_dos="<?php echo $garde['to_do']; ?>" 
                        data-bs-target="#exampleModal">✏️
                </button>
                <button class="delete-btn">
                    <a href="app.php?delete=<?php echo $garde['id']; ?>" style="text-decoration: none; color: inherit;">🗑️</a>
                </button>

              </div>
            </li>
            <?php } ?>
            <!-- Fin affichage, validation et suppression -->
          </ul>
        </div>

        <div class="tasks-section">

          <h2>Done - 
              <!-- Comptage tache effectuée -->
             <?php 
              $requette = mysqli_query($connexion, "SELECT count(id) as nbr FROM add_ask WHERE etat = 1 AND username = '$username' ORDER BY id DESC");
              while ($garde=mysqli_fetch_assoc($requette)) {
                 echo $garde['nbr'];
             } ?>
             <!-- Fin -->
          </h2>

          <ul class="task-list">
            <!-- Affichage, remote et suppression tache(s) -->
            <?php 
            // Remote ou remettre la tacje à jour
            if (isset($_GET['remote'])) {
              $id = $_GET['remote'];
              $requette = mysqli_query($connexion, "UPDATE add_ask SET etat = 0 WHERE id = '$id' AND username = '$username' ");
              echo "<script>
                    window.location.replace('app.php');
                    </script>";
              }

            // Suppression de la tache effectuée
            if (isset($_GET['real_delete'])) {
              $id = $_GET['real_delete'];
              $requette = mysqli_query($connexion, "DELETE FROM add_ask WHERE id = '$id' AND username = '$username' ");
              echo "<script>
                    window.location.replace('app.php');
                    </script>";
              }

              // Affichage tache(s) effectuéé(s)
              $req=mysqli_query($connexion, "SELECT * FROM  add_ask WHERE etat = 1 AND username ='$username'");
              while ($garde=mysqli_fetch_assoc($req)) { ?>

            <li>
              <span class="task-name completed"><?php echo $garde['to_do']; ?></span>
              <div class="task-actions">
                <button class="undo-btn"><a href="app.php?remote=<?php echo $garde['id']; ?>" style="text-decoration: none;">↩️</a></button>
                <button class="delete-btn"><a href="app.php?real_delete=<?php echo $garde['id']; ?>" style="text-decoration: none;">🗑️</a></button>
              </div>
            </li>
             <?php } ?>
             <!-- fin -->

          </ul>
        </div>
      </div>
    </main>
  </div>

  <!-- Modal modification -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background: #2b2b40;">
          <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #fff;">Update Task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?php 
        if (isset($_POST['update'])) {
        extract($_POST);

        $req = mysqli_query($connexion, "UPDATE add_ask SET to_do ='$to_do' WHERE id = '$idss' ");

        echo "<script>
              Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Task updated.😉',
              showConfirmButton: false,
              timer: 3500
              });
              setInterval(function () {
              window.location.replace('app.php');
              }, 3500);
              </script>";
        }

        ?>
        <form method="post">
        <div class="modal-body">
          <div class="mb-3">
            <input type="hidden" id="idss" name="idss">
            <label for="to_dos" class="form-label" style="color: #000;">Task</label>
            <input type="text" id="to_dos" class="form-control" name="to_do" required style="background-color: #23233b; color: #7f5af0;">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn" style="background: #7f5af0; color: #fff" name="update">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- Bootstrap and jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  </script>
     <!-- Script suppression -->
      <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idss = button.data('idss'); 
        var to_dos = button.data('to_dos'); 
     
        var modal = $(this);
        modal.find('#idss').val(idss);
        modal.find('#to_dos').val(to_dos);
        });
  </script>
</body>
</html>
