<?php

require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = trim($_POST["nom"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $motdepasse = $_POST["motdepasse"] ?? "";

    if ($nom === "" || $email === "" || $motdepasse === "") {
        $msg = "Tous les champs sont obligatoires.";
        header("Location: inscription.php?erreur=" . urlencode($msg));
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Email invalide.";
        header("Location: inscription.php?erreur=" . urlencode($msg));
        exit;
    }
    if (strlen($motdepasse) < 6) {
        $msg = "Le mot de passe doit contenir au moins 6 caractères.";
        header("Location: inscription.php?erreur=" . urlencode($msg));
        exit;
    }

    $sql = "SELECT id FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch();
    if ($user) {
        $msg = "Cet email est déjà utilisé.";
        header("Location: inscription.php?erreur=" . urlencode($msg));
        exit;
    }

    $hash = password_hash($motdepasse, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nom, email, mot_de_passe, created_at)
            VALUES (:nom, :email, :mot_de_passe, :created_at)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            "nom" => $nom,
            "email" => $email,
            "mot_de_passe" => $hash,
            "created_at" => date("Y-m-d H:i:s")
        ]);
        $msg = "Inscription réussie !";
        header("Location: inscription.php?succes=" . urlencode($msg));
        exit;
    } catch (PDOException $e) {
        $msg = "Erreur lors de l'inscription.";
        header("Location: inscription.php?erreur=" . urlencode($msg));
        exit;
    }
} else {
    echo "Méthode non autorisée.";
}