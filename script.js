$(document).ready(function() {
    // Inizializza il dialog nascosto
    $("#confirmationPopup").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "OK": function() {
                $(this).dialog("close");
            }
        }
    });

    // Aggiungi il gestore dell'evento click al pulsante "Inserisci Prodotto"
    $("#insertProductButton").click(function() {
        submitProduct();
    });

    function submitProduct() {
        var productName = $("#productName").val();
        var productWeight = $("#productWeight").val();
        var productQuantity = $("#productQuantity").val();
        var productPrice = $("#productPrice").val();
        var isCeliacFriendly = $("#isCeliacFriendly").val();
        var isLactoseFree = $("#isLactoseFree").val();
        var isReintegrable = $("#isReintegrable").val();

        // Effettua una richiesta AJAX per inviare i dati al server
        $.ajax({
            url: 'insert.php',
            method: 'POST',
            data: $("#productForm").serialize(),
            success: function(response) {
                // Mostra la popup con i dati inseriti in un formato più leggibile
                var confirmationMessage =
                    "Prodotto inserito con successo!\n" +
                    "Nome: " + productName + "\n" +
                    "Peso: " + productWeight + "\n" +
                    "Quantità: " + productQuantity + "\n" +
                    "Prezzo: " + productPrice + "\n" +
                    "Per Celiaci: " + isCeliacFriendly + "\n" +
                    "Per Allergici al Lattosio: " + isLactoseFree + "\n" +
                    "Reintegrabile: " + isReintegrable;
                
                $("#popupContent").text(confirmationMessage);
                $("#confirmationPopup").dialog("open");
                
                // Svuota i campi del modulo
                $("#productForm")[0].reset();
            },
            error: function() {
                alert('Errore durante la richiesta AJAX.');
            }
        });
    }
});
