window.addEventListener("load", function () {
    var loginForm = document.getElementById("login");

    function sendData() {
        var xhr = new XMLHttpRequest();

        var loginData = new FormData(loginForm);

        var message = document.getElementById("message");

        var messageText = document.createElement("p");

        xhr.onreadystatechange = function () {
            if (xhr.readyState != 4) {
                message.innerHTML = "";
                messageText.textContent = "Connexion...";
                message.appendChild(messageText);
            } else {
                message.innerHTML = "";
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response["reponse"] == 1) {
                        sessionStorage.setItem("login", response["login"]);
                        window.location.href = "publication.html";
                    } else {
                        messageText.textContent = "Nom d'utilisateur ou mot de passe incorrect.";
                        messageText.style.color = "red";
                        message.appendChild(messageText);
                    }
                } else {
                    messageText.textContent = "Erreur lors de la connexion au serveur.";
                    messageText.style.color = "yellow";
                    message.appendChild(messageText);
                }
            }
        };

        xhr.addEventListener("error", function (event) {
            alert("Oups! Quelque chose s'est mal passé.");
        });

        xhr.open("POST", "traitements/traitement-login.php");

        xhr.send(loginData);
    }

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault();
        sendData();
    });
});
