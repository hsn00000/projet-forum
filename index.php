<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '&6HAUTdanslaFauré');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

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
                <a href="index.php" class="d-flex align-items-center link-body-emphasis text-decoration-none me-4">
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
                Participation au Concours au sein du Lycée Gabriel Fauré
            </h1>
        </center>

        <br><br>

        <blockquote class="blockquote">
            <p>L'entreprise <strong><a href="site.html" target="_blank"
                        class="text-decoration-none">INNOV'events</a></strong> organise un concours destiné aux
                élèves du Lycée Gabriel Fauré !
                <br><br>Ce concours a pour but de récompenser les jeunes en les encourageant à poursuivre leurs efforts
                et cela permet d'accroître la visibilité de notre marque.<br><br>Pour participer, il suffit de répondre
                à une question.<br>Une bonne réponse
                vous donne une chance
                de gagner un <br><strong><u>AirPods Max Argent</u></strong>.<br><br>Les résulats seront sous la forme
                d'un tirage au sort.
            </p>
            <footer class="blockquote-footer">Organisateur de l'évenement</footer>
        </blockquote>

        <br><br>

        <div>
            <img src="images/image_concours.jpeg" alt="Image 1" class="img-fluid" width="100%" style="height: auto;">
        </div>

        <br><br>

        <p class="text-black lead highlight">La question est la suivante :</p>

        <div class="container">
            <p class="question">
                Je possède une cicatrice sur le front et depuis, je suis « l’élu ». Qui-suis-je ?
            </p>
            <select id="reponse" class="form mb-3">
                <option value="Cristiano Ronaldo">Cristiano Ronaldo</option>
                <option value="Harry Potter">Harry Potter</option>
                <option value="Frodo Baggins">Frodo Baggins</option>
                <option value="Superman">Superman</option>
            </select>

            <form action="inscription.php" method="post" enctype="multipart/form-data">
                <p class="text-black lead highlight">Entrez votre mail, <br>ci-dessous:</p>
                <p id="message-erreur" style="color: red; display: none;"></p>
                <input type="email" name="mail" class="form-control mb-3" placeholder="Entrez votre adresse e-mail"
                    required>
                <p class="note">Ceci ne vous engage en rien.</p>
                <button type="submit" class="btn btn-primary btn-lg">Envoyer votre participation</button>
            </form>
        </div>
    </main>
    <script src="/js/script.js"></script>
</body>

</html>