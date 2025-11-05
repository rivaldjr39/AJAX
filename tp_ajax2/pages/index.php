<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<script type="text/javascript">

//Les codes ci dessous sont executé lors que la page est chargée
        window.addEventListener("load", function () {
            
        function sendData() {
            var xhr = new XMLHttpRequest(); 

            

            // Liez l'objet FormData et l'élément form
            var formData = new FormData(form);

            // Définissez ce qui se passe si la soumission s'est opérée avec succès
            xhr.addEventListener("load", function(event) {
        
             var retour = JSON.parse(event.target.responseText);
                if(retour === 1){
                    window.location.href = "../pages/index1.php";
                }else{
                    alert("Nom d'utilisateur ou mot de passe incorrect");
                }
            });

            // Definissez ce qui se passe en cas d'erreur
            xhr.addEventListener("error", function(event) {
            alert('Oups! Quelque chose s\'est mal passé.');
            });

            // Configurez la requête
            xhr.open("POST", "../traitement/traitement.php");

            // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
            xhr.send(formData);
        }

        // Accédez à l'élément form …
        var form = document.getElementById("From");

        // … et prenez en charge l'événement submit.
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // évite de faire le submit par défaut

            sendData();
        });
    });

</script>
<body>
    <form id="From">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>