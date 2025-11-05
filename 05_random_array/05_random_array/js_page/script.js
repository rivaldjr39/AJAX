
        var generer = document.getElementById("generer");
        var nombre = document.getElementById("nombre");
        var cartes = document.getElementById("cartes");

        generer.addEventListener("click", () => {
            let count = Number(nombre.value);
            let imagecarte = [
                "assets/images/c1.jpg",
                "assets/images/c2.jpg",
                "assets/images/c3.jpg",
                "assets/images/c4.jpg",
                "assets/images/c5.jpg",
                "assets/images/c6.jpg",
                "assets/images/c7.jpg",
                "assets/images/c8.jpg",
                "assets/images/c9.jpg",
                "assets/images/c10.jpg",
                "assets/images/c11.jpg",
                "assets/images/c12.jpg",
                "assets/images/c13.jpg",
                "assets/images/k2.jpg",
                "assets/images/k3.jpg",
                "assets/images/k4.jpg",
                "assets/images/k5.jpg",
                "assets/images/k6.jpg",
                "assets/images/k7.jpg",
                "assets/images/k8.jpg",
                "assets/images/k9.jpg",
                "assets/images/k10.jpg",
                "assets/images/k11.jpg",
                "assets/images/k12.jpg",
                "assets/images/k13.jpg",
                "assets/images/p2.jpg",
                "assets/images/p3.jpg",
                "assets/images/p4.jpg",
                "assets/images/p5.jpg",
                "assets/images/p6.jpg",
                "assets/images/p7.jpg",
                "assets/images/p8.jpg",
                "assets/images/p9.jpg",
                "assets/images/p10.jpg",
                "assets/images/p11.jpg",
                "assets/images/p12.jpg",
                "assets/images/p13.jpg",
                "assets/images/t2.jpg",
                "assets/images/t3.jpg",
                "assets/images/t4.jpg",
                "assets/images/t5.jpg",
                "assets/images/t6.jpg",
                "assets/images/t7.jpg",
                "assets/images/t8.jpg",
                "assets/images/t9.jpg",
                

            ];

            cartes.innerHTML = ""; 

            for (let i = 0; i < count; i++) {
                let carteDiv = document.createElement("div");
                carteDiv.classList.add("carte");

                let randomIndex = Math.floor(Math.random() * imagecarte.length);
                let img = document.createElement("img");
                img.src = imagecarte[randomIndex];

                let button = document.createElement("button");
                button.innerText = "Changer";

                button.addEventListener("click", () => {
                    let newIndex = Math.floor(Math.random() * imagecarte.length);
                    img.src = imagecarte[newIndex];
                });

                carteDiv.appendChild(img);
                carteDiv.appendChild(button);

                cartes.appendChild(carteDiv);
            }
        });