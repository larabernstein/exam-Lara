
<?php

$erreur = $_GET["erreur"] ?? null;
$succes = $_GET["succes"] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { max-width: 400px; margin: 40px auto; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        .btn { margin-top: 15px; padding: 10px; cursor: pointer; }
        .message-erreur { color: red; }
        .message-succes { color: green; }
    </style>
</head>
<body>
<h1 style="text-align:center;">Formulaire d'inscription</h1>
<?php if ($erreur): ?>
    <p class="message-erreur"><?php echo htmlspecialchars($erreur); ?></p>
<?php endif; ?>
<?php if ($succes): ?>
    <p class="message-succes"><?php echo htmlspecialchars($succes); ?></p>
<?php endif; ?>
<form action="traitement_inscription.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>
    <label for="motdepasse">Mot de passe :</label>
    <input type="password" id="motdepasse" name="motdepasse" required>
    <button type="submit" class="btn">S'inscrire</button>
</form>
</body>
</html>