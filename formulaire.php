<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '&6HAUTdanslaFauré');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM etudiant');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concours Lycée</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container d-flex align-items-center">
                <a href="formulaire.php" class="d-flex align-items-center link-body-emphasis text-decoration-none me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="32" fill="currentColor"
                        class="bi bi-bank" viewBox="0 0 16 16">
                        <path
                            d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z" />
                    </svg>
                    <span class="fs-5 fw-bold">Concours Lycée Gabriel Fauré</span>
                </a>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <center>
            <h1 class="text-black highlight">
                Formulaire d'inscription au concours
            </h1>
        </center>

        <br><br>

        <blockquote class="blockquote">
            <p>Il vous manque une derniere etape
                avant de valider votre inscription pour gagner un<strong><u><br>AirPods Max
                        Argent</u>. <br><br>Vous devez finaliser le formulaire</strong>.
            </p>
            <footer class="blockquote-footer">Organisateur de l'évenement</footer>
        </blockquote>

        <br><br>

        <div>
            <img src="images/image_concours.jpeg" alt="Image 1" class="img-fluid" width="100%" style="height: auto;">
        </div>

        <br><br>

        <p class="text-black lead highlight">Le formulaire est ci-dessous :</p>

        <div class="container">
            <form action="inscriptionFormulaire.php" method="post" class="p-4 shadow bg-white rounded"
                enctype="multipart/form-data">

                <!-- Nom -->
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                </div>

                <!-- Prénom -->
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom"
                        required>
                </div>

                <!-- Date de naissance -->
                <div class="mb-3">
                    <label for="dateNaissance" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
                </div>

                <!--mail -->
                <div class="mb-3">
                    <label for="mail" class="form-label">Adresse e-mail</label>
                    <input type="mail" name="mail" class="form-control mb-3" placeholder="Entrez votre adresse e-mail"
                        required>
                </div>

                <!-- Numéro de téléphone -->
                <div class="mb-3">
                    <label for="telephone" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="06XXXXXXXX"
                        pattern="[0-9]{10}" required>
                </div>

                <!-- Mot de passe -->
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Entrez un mot de passe"
                        required>
                </div>

                <!-- Bouton de soumission -->
                <br><button type="submit" class="btn btn-primary w-100">Envoyer le formulaire d'inscription</button>
            </form>
        </div>
        </div>
    </main>
</body>

</html>