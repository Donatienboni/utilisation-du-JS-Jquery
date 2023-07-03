<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $depart = $_POST["depart"];
    $arrive = $_POST["arrive"];
    $prix = $_POST["prix"];
    $voiture = $_POST["voiture"];
    $forfait = $_POST["forfait"];
    $date = $_POST["date"];
   

    // Effectuer les opérations de traitement ou de validation des données ici
    // ...

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agencemmi3";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {  
        die("Connexion échouée: " .$conn->connect_error);
    }

    // Préparer et exécuter la requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO voyages (nom, prenom, depart, arrive, prix, voiture, forfait, ddate) 
            VALUES ('$nom', '$prenom', '$depart', '$arrive', '$prix', '$voiture', '$forfait','$date')";

    if ($conn->query($sql) === TRUE) {
        echo "Réservation effectuée avec succès.";
        header("location:espace.php");
    } else {
        echo "Erreur lors de la réservation: " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
