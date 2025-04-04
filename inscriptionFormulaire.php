<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '&6HAUTdanslaFauré');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérifier si tous les champs sont remplis
if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mail']) && 
    !empty($_POST['telephone']) && !empty($_POST['dateNaissance']) && !empty($_POST['mdp'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $telephone = $_POST['telephone'];
    $dateNaissance = $_POST['dateNaissance'];
    $mdp = $_POST['mdp'];

    // Vérifier si l'email est déjà enregistré
    $check = $bdd->prepare('SELECT COUNT(*) FROM etudiant WHERE mail = ?');
    $check->execute([$mail]);
    $count = $check->fetchColumn();

    if ($count == 0) { // Si l'email n'existe pas encore
        $ajouter = $bdd->prepare('INSERT INTO etudiant (nom, prenom, mail, telephone, dateNaissance, mdp) VALUES (?, ?, ?, ?, ?, ?)');
        $ajouter->execute([$nom, $prenom, $mail, $telephone, $dateNaissance, $mdp]);

        // Redirection avec message de succès
        header("Location: succesFormulaire.html?success=1");
        exit();
        
    } else { // Si l'email existe, on met à jour les informations
        $update = $bdd->prepare('UPDATE etudiant SET nom = ?, prenom = ?, telephone = ?, dateNaissance = ?, mdp = ? WHERE mail = ?');
        $update->execute([$nom, $prenom, $telephone, $dateNaissance, $mdp, $mail]);

        // Redirection avec message de mise à jour
        header("Location: succesFormulaire.html?updated=1");
        exit();
    }
} else {
    // Redirection avec message d'erreur (champs vides)
    header("Location: formulaire.php?error=2");
    exit();
}
?>