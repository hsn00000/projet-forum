<?php
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

    <h2>Interface Admin MySQL - Table Étudiants</h2>

    <form method="POST">
        <label for="query">Requête SQL :</label><br>
        <textarea name="query" id="query" rows="4" cols="50" placeholder="Exemple : SELECT * FROM etudiant WHERE nom='Dupont';"></textarea><br>
        <button type="submit">Exécuter</button>
    </form>

    <?php if (!empty($message)) : ?>
        <p style="color: red;"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

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
