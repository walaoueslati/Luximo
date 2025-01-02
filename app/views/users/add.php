<?php
$title = "Inscription";
ob_start();
?>
<div>
    <h1>Inscription</h1>
    <form id="signupForm" action="../../controllers/UserController.php?action=add" method="POST">
      <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">password :</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">S'inscrire</button>
      <a href="./signin.php">Vous n'avez pas de compte ? Inscrivez-vous ici.</a>
      </form>
  </div>
<?php
$content = ob_get_clean();
include '../layout.php';