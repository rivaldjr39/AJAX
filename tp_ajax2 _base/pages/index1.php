<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication & Commentaire</title>
    <style>
        .publication {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 10px;
            width:50vh;
        }
        .comment {
            margin-left: 20px;
            font-size: 14px;
        }
        .comment-form {
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <h2>Mur de publications</h2>
    <form id="From">
        <input type="text" id="text_pub" name="text_pub" placeholder="Écris ta publication..." required>
        <input type="submit" value="Publier">
    </form>
    <div id="publications"></div>

<script type="text/javascript">
window.addEventListener("load", function () {
    function sendData(formData, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../traitement/traitement1.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                callback(JSON.parse(xhr.responseText));
            }
        };
        xhr.send(formData);
    }

    
    function loadPublications() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../traitement/traitement1.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                var container = document.getElementById("publications");
                container.innerHTML = "";

                data.forEach(function(pub) {
                    var div = document.createElement("div");
                    div.className = "publication";
                    div.dataset.id = pub.id_publication;
                    div.innerHTML = "<b>" + pub.auteur_pub + " :</b> " + pub.publication_texte;

                    if (pub.commentaires.length > 0) {
                        pub.commentaires.forEach(function(comm) {
                            var c = document.createElement("div");
                            c.className = "comment";
                            c.innerHTML = "<i>" + comm.auteur_comm + " :</i> " + comm.commentaire_texte;
                            div.appendChild(c);
                        });
                    }

                   
                    var formCom = document.createElement("form");
                    formCom.className = "comment-form";
                    formCom.innerHTML = `
                        <input type="hidden" name="id_publication" value="${pub.id_publication}">
                        <input type="text" name="text_comm" placeholder="Écris un commentaire..." required>
                        <input type="submit" value="Commenter">
                    `;
                    div.appendChild(formCom);

                    div.addEventListener("click", function() {
                        var allForms = document.querySelectorAll(".comment-form");
                        allForms.forEach(f => f.style.display = "none");
                        formCom.style.display = "block";
                    });


                    formCom.addEventListener("submit", function(e) {
                        e.preventDefault();
                        var fd = new FormData(formCom);
                        sendData(fd, function(retour) {
                            var c = document.createElement("div");
                            c.className = "comment";
                            c.innerHTML = "<i>" + retour.nom + " :</i> " + retour.texte;
                            formCom.before(c);
                            formCom.reset();
                        });
                    });

                    container.appendChild(div);
                });
            }
        };
        xhr.send();
    }

    var formPub = document.getElementById("From");
    formPub.addEventListener("submit", function(event) {
        event.preventDefault();
        var fd = new FormData(formPub);
        sendData(fd, function(retour) {
            formPub.reset();
            loadPublications(); 
        });
    });

    loadPublications(); 
});
</script>
</body>
</html>
