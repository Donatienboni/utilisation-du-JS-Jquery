<?php
// Configuration de la connexion à la base de données
include 'config.php';

// Récupération des valeurs des champs du formulaire
$email = $_POST["email"];
$pass = $_POST["password"];

// Requête de sélection de l'utilisateur correspondant à l'email et au mot de passe fournis
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND pass = ?");
$stmt->bind_param("ss", $email, $pass);
$stmt->execute();

// Récupération du résultat de la requête
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // L'utilisateur existe, l'authentification réussie
    $response = array("success" => true, "message" => "Authentification réussie !", "redirect" => "espace.php");
    echo json_encode($response);
} else {
    // L'utilisateur n'existe pas ou l'authentification a échoué
    $response = array("success" => false, "message" => "Authentification échouée : identifiants incorrects.");
    echo json_encode($response);
}

// Fermeture de la connexion et de la déclaration préparée
$stmt->close();
$conn->close();
?>