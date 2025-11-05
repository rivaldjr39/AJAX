<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication & Commentaire</title>
</head>
<body>
    <!-- FORMULAIRE DE PUBLICATION -->
    <form id="From">
        <input type="text" id="text_pub" name="text_pub" placeholder="Écris ta publication..." required>
        <br><br>
        <input type="submit" value="Publier">
        <h5 id="reponse"></h5>
    </form>

    
    <form id="commentaire">
        <h5 id="reponse_comment"></h5>
        <input type="text" id="text_comm" name="text_comm" placeholder="Écris ton commentaire..." required>
        <br><br>
        <input type="submit" value="Commenter">
    </form>

<script type="text/javascript">
window.addEventListener("load", function () {

    var commentaire = document.getElementById("commentaire");
    commentaire.style.display = "none"; 

   
    function sendData(form, type) {
        var xhr = new XMLHttpRequest();
        var formData = new FormData(form);

        xhr.addEventListener("load", function(event) {
            var retour = JSON.parse(event.target.responseText);
            
            if (retour ) {
                if (type === "publication") {
                    var reponse = document.getElementById("reponse")
                    var p = document.createElement("p");
                    for (let index = 0; index < retour.length; index++) {
                        reponse.appendChild(p);
                        p.innerHTML += retour;
                    }
                    commentaire.style.display = "block"; 
                } else if (type === "commentaire") {
                    var reponse1 = document.getElementById("reponse_comment")
                    var p1 = document.createElement("p");
                    for (let index = 0; index < retour.length; index++) {
                        reponse1.appendChild(p1);
                        p1.innerHTML +="reponse :"+ retour;
                    }
                }
            } else {
                alert("Erreur lors de l'envoi des données !");
            }
        });

        xhr.addEventListener("error", function() {
            alert("Oups ! Une erreur est survenue lors de la requête.");
        });

        xhr.open("POST", "../traitement/traitement1.php");
        xhr.send(formData);
    }

    // 🔸 Récupération des deux formulaires
    var formPub = document.getElementById("From");
    var formCom = document.getElementById("commentaire");

    // 🔸 Soumission de la publication
    formPub.addEventListener("submit", function(event) {
        event.preventDefault();
        sendData(formPub, "publication");
    });

    // 🔸 Soumission du commentaire
    formCom.addEventListener("submit", function(event) {
        event.preventDefault();
        sendData(formCom, "commentaire");
    });
});
</script>
</body>
</html>
