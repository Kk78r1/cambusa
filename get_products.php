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

// Query per ottenere i dati dei prodotti
$sql = "SELECT * FROM Products";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = array();

    while ($row = $result->fetch_assoc()) {
        $products[] = array(
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

    // Restituisci i dati dei prodotti come JSON
    echo json_encode($products);
} else {
    echo "Nessun prodotto trovato.";
}

$conn->close();
?>
