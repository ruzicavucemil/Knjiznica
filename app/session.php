<?php

    // URL web stranice.
    define('URL', 'https://moja-knjizaraa.000webhostapp.com/');

    // Dohvatanje sesijskih varijabla.
    session_start();

    // Pomoćna funkcija za provjeravanje da li je
    // korisnik prijavljen ili ne.
    function checkSession(){
        if(isset($_SESSION['email'])){
            return true;
        }else{
            return false;
        }
    }

    // Pomoćna funkcija za provjeravanje da li je
    // prijavljenji korisnik admin.
    function checkAdminSession(){
        if(isset($_SESSION['email'])){
            if($_SESSION['email'] == 'admin@gmail.com'){
                return true;
            }
        }
        return false;
    }

    // Nakon odjave, izbriši sesiju.
    function removeSession(){
        unset($_SESSION['email']);
    }

?>
