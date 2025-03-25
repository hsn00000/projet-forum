<?php
session_start();

// Définition des identifiants d'accès
$utilisateur = "admin";
$mot_de_passe = "LaisseMoiDormir3274";

// Vérification du formulaire de connexion
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === $utilisateur && $_POST['password'] === $mot_de_passe) {
        $_SESSION['loggedin'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $erreur = "Identifiants incorrects !";
    }
}

// Rediriger vers la connexion si l'utilisateur n'est pas authentifié
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>
    </head>
    <body>
        <h2>Connexion requise</h2>
        <form method="post">
            <label>Nom d'utilisateur :</label>
            <input type="text" name="username" required><br>
            <label>Mot de passe :</label>
            <input type="password" name="password" required><br>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>
    </body>
    </html>
    <?php
    exit();
}

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '&6HAUTdanslaFauré');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Initialisation des variables
$resultats = [];
$message = '';

// Requête par défaut : afficher tous les étudiants
$requete = "SELECT * FROM etudiant";

// Vérification si une requête est envoyée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['query'])) {
    $requete = trim($_POST['query']);

    // Vérification pour éviter des suppressions accidentelles
    if (preg_match('/\b(DELETE|DROP|TRUNCATE)\b/i', $requete)) {
        $message = "Requêtes DELETE, DROP et TRUNCATE interdites.";
    } else {
        try {
            $stmt = $bdd->query($requete);
            if ($stmt) {
                $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC); // Éviter les doublons
            }
        } catch (Exception $e) {
            $message = 'Erreur SQL : ' . $e->getMessage();
        }
    }
} else {
    // Exécution de la requête par défaut
    $stmt = $bdd->query($requete);
    if ($stmt) {
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC); // Éviter les doublons
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin MySQL - Étudiants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h2>Interface Admin MySQL - Table etudiant</h2>


    <?php if (!empty($resultats)) : ?>
        <h3>Résultats :</h3>
        <table>
            <thead>
                <tr>
                    <?php foreach (array_keys(reset($resultats)) as $colonne) : ?>
                        <th><?= htmlspecialchars($colonne, ENT_QUOTES, 'UTF-8') ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats as $ligne) : ?>
                    <tr>
                        <?php foreach ($ligne as $valeur) : ?>
                            <td><?= htmlspecialchars($valeur ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <p>Aucun résultat ou requête invalide.</p>
    <?php endif; ?>

</body>
</html>

