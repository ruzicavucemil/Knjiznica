<?php 

    // Pri potvrdi forme za prijavu, šalje se POST zahtjev.
    // Podatci iz kolačića se šalju kao POST request.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Sav sadržaj poslanog requesta se čita kao JSON.
        // P.S. Riješenje s interneta.
        $content = file_get_contents("php://input");
        $content = trim(file_get_contents("php://input"));
        $books_array = json_decode($content, true);
        
        include '../app/database.php';
        
        // Unos ukupne cijene u tablicu 'kupovina'.
        initializeConnection();
        buyBooks($books_array);
        closeConnection();

    }

?>