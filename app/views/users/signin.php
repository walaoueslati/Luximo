<?php
$title = "Inscription";
ob_start();
?>



<div>
    <h1>Login</h1>
    <form id="loginForm" action="../../controllers/UserController.php?action=login" method="POST">
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
        <a href="./add.php">Vous n'avez pas de compte ? Inscrivez-vous ici.</a>
    </form>
</div>
<?php
$content = ob_get_clean();
include '../layout.php';
?>