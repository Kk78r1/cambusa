<?php
// Abilita l'accesso da qualsiasi origine (CORS)
header("Access-Control-Allow-Origin: *");

// Configurazione per la connessione al database
$servername = "localhost"; // Nome del tuo server MySQL
$username = "root"; // Tuo nome utente MySQL
$password = ""; // Password del database
$dbname = "cambusa"; // Nome del tuo database

// Creazione della connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Query per ottenere i dati dei prodotti reintegrabili
$sql = "SELECT * FROM Products WHERE IsReintegrable = 'Si'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $reintegrableProducts = array();

    while ($row = $result->fetch_assoc()) {
        $reintegrableProducts[] = array(
            "productId" => $row["ProductID"],
            "productName" => $row["ProductName"],
            "productWeight" => $row["Weight"],
            "productQuantity" => $row["Quantity"],
            "productPrice" => $row["Price"],
            "isCeliacFriendly" => $row["IsCeliacFriendly"],
            "isLactoseFree" => $row["IsLactoseFree"],
            "isReintegrable" => $row["IsReintegrable"]
        );
    }

    // Restituisci i dati dei prodotti reintegrabili come JSON
    echo json_encode($reintegrableProducts);
} else {
    echo "Nessun prodotto reintegrabile trovato.";
}

$conn->close();
?>
