<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '&6HAUTdanslaFauré');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérifier si l'email est envoyé
if (!empty($_POST['mail'])) {
    $mail = $_POST['mail'];

    // Vérification pour éviter les doublons
    $check = $bdd->prepare('SELECT COUNT(*) FROM etudiant WHERE mail = ?');
    $check->execute([$mail]);
    $count = $check->fetchColumn();

    if ($count == 0) { // Si l'email n'existe pas encore
        $ajouter = $bdd->prepare('INSERT INTO etudiant (mail) VALUES (?)');
        $ajouter->execute([$mail]);

        // Redirection avec un message de succès
        header("Location: succes.html?success=1");
        exit();
    } else {
        // Redirection avec un message d'erreur
        header("Location: index.php?error=1");
        exit();
    }
} else {
    header("Location: index.php?error=2");
    exit();
}
?>