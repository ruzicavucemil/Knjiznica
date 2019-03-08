<?php

    include 'app/session.php';

    // Pri potvrdi forme za registraciju, šalje se POST zahtjev.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Podatci iz forme se pohranjuju.
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        
        include 'app/database.php';
        
        // Provjera podataka.
        initializeConnection();
        $redirect_ = registerCheck($email, $pass, 
                                   $first_name, $last_name, 
                                   $age);
        closeConnection();

        // Ako je registracija uspješna, novo registriranog
        // korisnika se preusmjerava na "prijava" stranicu
        // te ga se obavještava da se može uspješno prijaviti.
        if($redirect_){
            $_SESSION['success_msg'] = true;
            header('Location: '.URL.'login.php');
        }else{

            // Ako se desila greška ili korisnik već postoji,
            // obavještava se korisnika o grešci ili o tome
            // da takav korisnik već postoji.
            $failure_msg = true;
        }

    }else{ // GET request

        // Ako je korisnik već prijavljen, ne dopušta
        // mu se odlazak na "registracija" stranicu.
        if(checkSession()){
            header('Location: '.URL.'index.php');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <title>Online Knjizara | 
        <?php echo 'Registracija'; /*Custom title*/ ?>
    </title>

    <style>
        #register_form{
            position: relative;
            left: 25%;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php include './partials/navbar.php'; ?>

    <!-- Content -->
    <main>
        <div class="row">
            <form class="col s6" id="register_form" method="POST">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="first_name" name="first_name" type="text" class="validate" required>
                        <label for="first_name">Ime</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" name="last_name" type="text" class="validate" required>
                        <label for="last_name">Prezime</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Please enter valid E-mail" id="email" name="email" type="email" class="validate" required>
                        <label for="email">E-mail</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" name="password" type="password" class="validate" minlength="8" required>
                        <label for="password">Lozinka</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="age" name="age" type="number" min="18" max="100" class="validate">
                        <label for="age">Godine</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light blue darken-1" type="submit" name="submit">Potvrdi
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </main>
    
    <!-- Footer -->
    <?php include './partials/footer.php'; ?>

    <?php 
        if(isset($failure_msg)){
            echo '<script language="javascript">';
            echo 'M.toast({html: "Korisnik vec postoji !"})';
            echo '</script>';
        }
    ?>

    
</body>
</html>