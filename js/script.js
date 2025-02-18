function envoyerReponse() {
    let email = document.getElementById("email").value;
    let reponse = document.getElementById("reponse").value;
    let messageErreur = document.getElementById("message-erreur");

    // Expression régulière pour valider l'email
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email) {
        messageErreur.textContent = "Veuillez entrer une adresse e-mail.";
        messageErreur.style.display = "block";
        return;
    } else if (!emailRegex.test(email)) {
        messageErreur.textContent = "Adresse e-mail invalide.";
        messageErreur.style.display = "block";
        return;
    } else {
        messageErreur.style.display = "none"; // Masquer l'erreur si tout est bon
    }

    let formData = new FormData();
    formData.append("email", email);
    formData.append("reponse", reponse);

    fetch("inscription.php", { 
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Affiche la réponse du serveur
    })
    .catch(error => {
        console.error("Erreur:", error);
    });
}
