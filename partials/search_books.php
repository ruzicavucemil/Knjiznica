<?php 

    include '../app/database.php';

    // Ispis svih knjiga pri pretraživanju.
    // Primljeni parametar 'naziv' služi za pretragu knjiga.
    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        initializeConnection();
        $books = searchBooks($_GET['naslov']);
        echo json_encode($books);
        closeConnection();
    }

?>
