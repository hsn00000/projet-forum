<?php
session_start();

// Identifiants de connexion
$utilisateur = 'admin';
$mot_de_passe = 'admin123';

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '&6HAUTdanslaFauré');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

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

// Si non connecté
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

// Récupération des étudiants
try {
    $stmt = $bdd->query("SELECT nom, prenom, telephone FROM etudiant ORDER BY nom ASC");
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $nombre_etudiants = count($etudiants);
} catch (Exception $e) {
    $etudiants = [];
    $nombre_etudiants = 0;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Étudiants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

    <h2>Liste des Étudiants</h2>
    <p><strong>Nombre total :</strong> <?= $nombre_etudiants ?></p>

    <?php if (!empty($etudiants)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($etudiants as $e) : ?>
                    <tr>
                        <td><?= htmlspecialchars($e['nom']) ?></td>
                        <td><?= htmlspecialchars($e['prenom']) ?></td>
                        <td><?= htmlspecialchars($e['telephone']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun étudiant trouvé.</p>
    <?php endif; ?>

</body>
</html>
