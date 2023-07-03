<?php
// Configuration de la connexion à la base de données
include 'config.php';

// Récupération des valeurs des champs du formulaire
$nom = $_POST["nom"];
$email = $_POST["email"];
$pass = $_POST["pass"];

// Préparation de la requête d'insertion
$stmt = $conn->prepare("INSERT INTO users (nom, email, pass) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nom, $email, $pass);

// Exécution de la requête d'insertion
if ($stmt->execute()) {
    // Enregistrement réussi
    $response = array("success" => true, "message" => "Enregistrement réussi !");
    echo json_encode($response);
} else {
    // Erreur lors de l'enregistrement
    $response = array("success" => false, "message" => "Erreur lors de l'enregistrement : " . $conn->error);
    echo json_encode($response);
}

// Fermeture de la connexion et de la déclaration préparée
$stmt->close();
$conn->close();
?>
