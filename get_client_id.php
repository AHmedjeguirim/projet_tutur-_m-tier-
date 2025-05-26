<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION["id_client"])) {
    echo json_encode(["id_client" => $_SESSION["id_client"]]);
} else {
    echo json_encode(["error" => "Utilisateur non connecté"]);
}
?>
