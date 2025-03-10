<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!isset($_GET['id'])) {
        header("Location:index.php");
        exit;
    }

    $id = $_GET['id'];

    $query = "DELETE FROM clients WHERE ID=$id";
    $result = $connection->query($query);

    if (!$result) {
        $errorMessage = "Invalid query: " . $connection->error;
        header("Location:index.php?error=" . urlencode($errorMessage));
        exit;
    }

    header("Location:index.php?success=Client deleted successfully");
    exit;
}
