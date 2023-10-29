<?php

// Connessione al DB 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cambusa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

// Prepara lo statement con placeholder
$stmt = $conn->prepare("INSERT INTO Products (ProductName, Weight, Quantity, Price, IsCeliacFriendly, IsLactoseFree, IsReintegrable) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Associa i parametri 
$stmt->bind_param("sssisss", $productName, $productWeight, $productQuantity, $productPrice, $isCeliacFriendly, $isLactoseFree, $isReintegrable);

// Assegna i valori dei parametri POST 
$productName = $_POST["productName"];
$productWeight = $_POST["productWeight"]; 
$productQuantity = $_POST["productQuantity"];
$productPrice = $_POST["productPrice"];
$isCeliacFriendly = $_POST["isCeliacFriendly"];
$isLactoseFree = $_POST["isLactoseFree"];
$isReintegrable = $_POST["isReintegrable"];

// Esegui lo statement
$stmt->execute(); 

// Controlla errori
if ($stmt->errno) {
  echo "Errore: " . $stmt->error;
}

// Chiudi connessione
$conn->close();

?>
