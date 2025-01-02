<?php
session_start();
$title = "Supprimer un utilisateur";
ob_start();

require_once '../models/User.php';

$userModel = new User();
$users = $userModel->getAllUsers(); 
?>

<h2>Supprimer un utilisateur</h2>

<?php if (empty($users)): ?>
    <p>Aucun utilisateur à supprimer.</p>
<?php else: ?>
    <form action="../../controllers/UserController.php?action=delete" method="POST">
        <label for="user_id">Sélectionnez un utilisateur :</label>
        <select name="user_id" id="user_id" required>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name']) ?> (<?= htmlspecialchars($user['email']) ?>)</option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Supprimer</button>
    </form>
<?php endif; ?>

<?php
$content = ob_get_clean();
include '../layout.php';
?>
