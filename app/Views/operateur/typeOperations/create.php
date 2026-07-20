<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Type Opération</title>

    <style>
        .ligne {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .ligne button {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <form action="<?= site_url('operateur/typesOperation/inserer') ?>" method="post">

        <?= csrf_field() ?>

        <label for="libelle">Type d'opération :</label>
        <input type="text" name="libelle" id="libelle" required>

        <h3>Barèmes frais</h3>

        <div id="baremes">

            <div class="ligne">

                <label>Montant minimum :</label>
                <input type="number" name="baremes[0][montant_min]" required>

                <label>Montant maximum :</label>
                <input type="number" name="baremes[0][montant_max]" required>

                <label>Valeur :</label>
                <input type="number" name="baremes[0][valeur]" required>

            </div>

        </div>


        <button type="button" onclick="ajouterLigne()">
            + Ajouter une tranche
        </button>

        <br><br>

        <button type="submit">
            Ajouter
        </button>

    </form>


    <script>
        let index = 1;


        function ajouterLigne() {

            let container = document.getElementById("baremes");


            let div = document.createElement("div");

            div.classList.add("ligne");


            div.innerHTML = `

        <label>Montant minimum :</label>
        <input type="number" 
               name="baremes[${index}][montant_min]" 
               required>


        <label>Montant maximum :</label>
        <input type="number" 
               name="baremes[${index}][montant_max]" 
               required>


        <label>Valeur :</label>
        <input type="number" 
               name="baremes[${index}][valeur]" 
               required>


        <button type="button" onclick="supprimerLigne(this)">
            Supprimer
        </button>

    `;


            container.appendChild(div);


            index++;
        }



        function supprimerLigne(button) {

            button.parentElement.remove();

        }
    </script>


</body>

</html>