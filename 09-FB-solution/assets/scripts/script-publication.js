function timeAgo(dateString) {
    if (!dateString) return "";

    var normalized = dateString.replace(" ", "T");
    var then = new Date(normalized);
    if (isNaN(then.getTime())) {
        then = new Date(normalized + "Z");
        if (isNaN(then.getTime())) return dateString;
    }

    var now = new Date();
    var diffMs = now - then;
    var diffSec = Math.floor(diffMs / 1000);
    var diffMin = Math.floor(diffSec / 60);
    var diffHour = Math.floor(diffMin / 60);
    var diffDay = Math.floor(diffHour / 24);

    if (diffDay > 0) return "il y a " + diffDay + " jour(s)";
    if (diffHour > 0) return "il y a " + diffHour + " heure(s)";
    if (diffMin > 0) return "il y a " + diffMin + " minute(s)";
    return "à l'instant";
}

function updatePublishedTimes() {
    var dateElems = document.querySelectorAll(".publication-date");
    dateElems.forEach(function (el) {
        var ts = el.dataset.timestamp;
        el.textContent = timeAgo(ts);
    });
}

function loadPublications() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var publicationsDiv = document.getElementById("publications");
                publicationsDiv.innerHTML = "";

                var publication = JSON.parse(xhr.responseText);
                for (var i = 0; i < publication.length; i++) {
                    const publicationDiv = document.createElement("div");
                    publicationDiv.classList.add("publication");

                    var publicationHeader = document.createElement("div");
                    publicationHeader.classList.add("publication-header");

                    var imageAuteur = document.createElement("img");
                    imageAuteur.src = "../assets/images/default.jpg";

                    var publicationHeaderAuteur = document.createElement("div");
                    publicationHeaderAuteur.classList.add("publication-header-auteur");

                    var auteurPublicationText = document.createElement("h5");
                    auteurPublicationText.textContent = publication[i]["auteur"];

                    var datePublicationText = document.createElement("small");
                    datePublicationText.classList.add("text-muted", "publication-date");
                    datePublicationText.style.fontSize = "11px";

                    var rawDate = publication[i]["date_publication"];
                    datePublicationText.dataset.timestamp = rawDate;
                    datePublicationText.textContent = timeAgo(rawDate);

                    var publicationText = document.createElement("p");
                    publicationText.innerHTML = publication[i]["publication"];

                    var publicationfooter = document.createElement("div");
                    publicationfooter.classList.add("publication-footer");

                    var like = document.createElement("button");
                    like.textContent = "J'aime";

                    var commenter = document.createElement("button");
                    commenter.textContent = "Commenter";

                    const formCommentaire = document.createElement("form");
                    formCommentaire.classList.add("commentaire-form");

                    const textArea = document.createElement("textarea");
                    textArea.setAttribute("placeholder", "Inserer votre commentaire");

                    const buttonCommenter = document.createElement("input");
                    buttonCommenter.setAttribute("type", "submit");
                    buttonCommenter.setAttribute("value", "Commenter");

                    formCommentaire.appendChild(textArea);
                    formCommentaire.appendChild(buttonCommenter);

                    commenter.addEventListener("click", function () {
                        if (publicationDiv.contains(formCommentaire)) {
                            publicationDiv.removeChild(formCommentaire);
                        } else {
                            publicationDiv.appendChild(formCommentaire);
                        }
                    });

                    publicationfooter.appendChild(like);
                    publicationfooter.appendChild(commenter);

                    publicationHeader.appendChild(imageAuteur);

                    publicationHeaderAuteur.appendChild(auteurPublicationText);
                    publicationHeaderAuteur.appendChild(datePublicationText);

                    publicationHeader.appendChild(publicationHeaderAuteur);

                    publicationDiv.appendChild(publicationHeader);
                    publicationDiv.appendChild(publicationText);
                    publicationDiv.appendChild(publicationfooter);

                    publicationsDiv.appendChild(publicationDiv);
                }

                updatePublishedTimes();
            } else {
                alert("Erreur lors du chargement des publications depuis le serveur.");
            }
        }
    };

    xhr.addEventListener("error", function (event) {
        alert("Oups! Quelque chose s'est mal passé.");
    });

    xhr.open("GET", "traitements/traitement-publication.php", true);

    xhr.send();
}

setInterval(updatePublishedTimes, 60 * 1000);

window.addEventListener("load", function () {
    loadPublications();

    var user = document.getElementById("user");
    var login = sessionStorage.getItem("login");

    var userText = document.createElement("p");
    userText.textContent = login;

    user.appendChild(userText);

    var auteurPublication = document.getElementById("auteur");
    auteurPublication.value = login;

    var publicationForm = document.getElementById("publication-form");

    function sendPublicationData() {
        var xhr = new XMLHttpRequest();
        var publicationData = new FormData(publicationForm);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                loadPublications();
                document.getElementById("publication").value = "";
            }
        };

        xhr.addEventListener("error", function (event) {
            alert("Oups! Quelque chose s'est mal passé.");
        });

        xhr.open("POST", "traitements/traitement-publication.php", true);
        xhr.send(publicationData);
    }

    publicationForm.addEventListener("submit", function (event) {
        event.preventDefault();
        sendPublicationData();
    });
});
