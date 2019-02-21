<?php 

    include 'app/session.php';

    // Obriši sesiju nakon odjave.
    removeSession();

    // Preusmjeri na početnu stranicu.
    header('Location: '.URL.'index.php');

?>