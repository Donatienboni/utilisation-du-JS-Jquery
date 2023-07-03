<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableaux de catégorie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="espace.css">
</head>
<body>
    <div class="container">
    <caption class="abc" >Tableau de catégorie - Bus</caption>
        <table class="table category-table">
            <thead>
                <tr>
                    <th>Modèle</th>
                    <th>Immatriculation</th>
                    <th>Prix (personne)</th>
                    <th>Capacité</th>
                    <th>Nom</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Récupérer les voitures de la catégorie "Bus"
                $voitures_bus_sql = "SELECT v.modele, v.immatriculation, v.prix, v.capacite, c.nom, c.description 
                FROM voitures AS v
                INNER JOIN categories AS c ON v.categorie_id = c.id
                WHERE v.categorie_id = 2";
                $voitures_bus_result = $conn->query($voitures_bus_sql);

                if ($voitures_bus_result->num_rows > 0) {
                    while ($voiture_bus_row = $voitures_bus_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $voiture_bus_row["modele"] . "</td>";
                        echo "<td>" . $voiture_bus_row["immatriculation"] . "</td>";
                        echo "<td>" . $voiture_bus_row["prix"] . "</td>";
                        echo "<td>" . $voiture_bus_row["capacite"] . "</td>";
                        echo "<td>" . $voiture_bus_row["nom"] . "</td>";
                        echo "<td>" . $voiture_bus_row["description"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucune voiture trouvée dans la catégorie 'Bus'.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary add-button" onclick="openModal(1)">reservation(Bus)</button>
    </div>

    <div class="container">
         <caption class="abc" >Tableau de catégorie - Canter</caption>
        <table class="table category-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Modèle</th>
                    <th>Immatriculation</th>
                    <th>Prix (personne)</th>
                    <th>Capacité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Récupérer les voitures de la catégorie Canter
                $voitures_canter_sql = "SELECT v.modele, v.immatriculation, v.prix, v.capacite, c.nom, c.description 
                FROM voitures AS v
                INNER JOIN categories AS c ON v.categorie_id = c.id
                WHERE v.categorie_id = 1";
                $voitures_canter_result = $conn->query($voitures_canter_sql);
                if ($voitures_canter_result->num_rows > 0) {
                    while ($voiture_canter_row = $voitures_canter_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $voiture_canter_row["nom"] . "</td>";
                        echo "<td>" . $voiture_canter_row["description"] . "</td>";
                        echo "<td>" . $voiture_canter_row["modele"] . "</td>";
                        echo "<td>" . $voiture_canter_row["immatriculation"] . "</td>";
                        echo "<td>" . $voiture_canter_row["prix"] . "</td>";
                        echo "<td>" . $voiture_canter_row["capacite"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucune voiture trouvée dans la catégorie 'Canter'.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary add-button" onclick="openModal(2)">reservation (Canter)</button>
    </div>

    <div class="container">
        <caption class="abc" >Tableau de catégorie - Pik-eup</caption>
        <table class="table category-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Modèle</th>
                    <th>Immatriculation</th>
                    <th>Prix (personne)</th>
                    <th>Capacité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Récupérer les voitures de la catégorie Pik-eup
                $voitures_pikeup_sql = "SELECT v.modele, v.immatriculation, v.prix, v.capacite, c.nom, c.description 
                FROM voitures AS v
                INNER JOIN categories AS c ON v.categorie_id = c.id
                WHERE v.categorie_id = 3";
                $voitures_pikeup_result = $conn->query($voitures_pikeup_sql);

                if ($voitures_pikeup_result->num_rows > 0) {
                    while ($voiture_pikeup_row = $voitures_pikeup_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $voiture_pikeup_row["nom"] . "</td>";
                        echo "<td>" . $voiture_pikeup_row["description"] . "</td>";
                        echo "<td>" . $voiture_pikeup_row["modele"] . "</td>";
                        echo "<td>" . $voiture_pikeup_row["immatriculation"] . "</td>";
                        echo "<td>" . $voiture_pikeup_row["prix"] . "</td>";
                        echo "<td>" . $voiture_pikeup_row["capacite"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucune voiture trouvée dans la catégorie 'Pik-eup'.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary add-button" onclick="openModal(3)">reservation (Pik-eup)</button>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="form-container">
                <form method="POST" action="traitementtt.php">
                    <h2>reservation du vehicule</h2>
                    <input type="hidden" name="categorie_id" id="categorie_id_input">

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom">

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom">

                    <label for="date">lieu_depart</label>
                    <input type="text" name="depart" id="depart">

                    <label for="arrive">lieu_arrivé</label>
                    <input type="text" name="arrive" id="arrive">

                    <label for="prix">prix_total</label>
                    <input type="number" name="prix" id="prix">

                    <label for="voiture">voiture</label>
                    <input type="text" name="voiture" id="voiture">

                    <label for="forfait">forfait</label>
                    <input type="text" name="forfait" id="forfait">

                    <label for="date">Date reservation</label>
                    <input type="date" name="date" id="date">


                    <input type="submit" value="reservation">
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ouvrir le modal avec le bon ID de catégorie
        function openModal(categorieId) {
            document.getElementById("categorie_id_input").value = categorieId;
            document.getElementById("myModal").style.display = "block";
        }

        // Fermer le modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</body>
</html>
