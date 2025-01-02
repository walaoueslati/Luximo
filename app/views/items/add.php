<?php
$title = "Ajouter un Item";
ob_start();

?>
<div>
<h1>Login</h1>

    <form action="../../controllers/ItemController.php?action=add" method="POST" enctype="multipart/form-data">
    <label for="name">Nom de l'Item :</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="description">Description :</label>
    <textarea name="description" id="description" required></textarea>
    <br>
    <label for="price">Prix :</label>
    <input type="number" name="price" id="price" step="0.01" required>
    <br>
    <label for="image">Image :</label>
    <input type="file" name="image" id="image" accept="image/*">
    <br>
    <button type="submit">Ajouter</button>
</form>
</div>
    

<?php
$content = ob_get_clean();
include '../layout.php';
?>
