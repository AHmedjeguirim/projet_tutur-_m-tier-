<?php
header("Content-Type: application/json");

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "pi";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Échec de connexion à la base de données"]));
}

// Déterminer la page actuelle
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // Nombre de clients par page
$offset = ($page - 1) * $limit;

// Récupérer les clients avec pagination
$sql = "SELECT * FROM client LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$clients = [];
while ($row = $result->fetch_assoc()) {
    $clients[] = $row;
}

// Récupérer le nombre total de clients
$sqlTotal = "SELECT COUNT(*) AS total FROM client";
$totalResult = $conn->query($sqlTotal);
$totalClients = $totalResult->fetch_assoc()['total'];

echo json_encode([
    "clients" => $clients,
    "totalClients" => $totalClients
]);
?>
