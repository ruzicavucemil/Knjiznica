<?php

    include 'app/session.php';

    // Pri potvrdi formi u admin sučelju, šalje se POST zahtjev.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        include 'app/database.php';

        initializeConnection();

        // Pri potvrdi prve forme, prikupljaju se svi podatci
        // da bi se stvorila nova knjiga.
        if(isset($_POST['form1'])){
            
            $naslov = $_POST['naslov'];
            $pisac = $_POST['pisac'];
            $isbn = $_POST['isbn'];
            $brojStranica = $_POST['brojStranica'];
            $cijena = $_POST['cijena'];
            $sadrzaj = $_POST['sadrzaj'];
            $slika = $_FILES['slika'];

            $notifikacija = createBook($naslov, $pisac, 
                       $isbn, $brojStranica, 
                       $cijena, $sadrzaj, $slika);

            // Sluzi samo za notifikacije.
            if($notifikacija){
                $_SESSION['success_msg'] = 'kreirano';
            }
        
        // Ako ako potvrđena druga forma (za izmjenu).
        }else{
            $idKnjige = $_POST['idKnjige'];
            $nazivStupca = $_POST['nazivStupca'];
            $novaVrijednost = $_POST['novaVrijednost'];

            $notifikacija = updateBook($idKnjige, $nazivStupca, $novaVrijednost);

            // Sluzi samo za notifikacije.
            if($notifikacija){
                $_SESSION['success_msg'] = 'izmjenjeno';
            }
        }
        
        closeConnection();

    }else{ // GET request

        // Dopuštenje pregleda admin sučelja samo za admina.
        // Ostali korisnici nemaju pristup.
        if(!checkAdminSession()){
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
        <?php echo 'Admin Panel'; /*Custom title*/ ?>
    </title>

    <style>
        #login_form{
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

            <!-- Form for creating new book -->
            <form class="col s6" id="create_book_form" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="naslov" name="naslov" type="text" class="validate" required>
                        <label for="naslov">Naslov knjige</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="pisac" name="pisac"  type="text" class="validate" required>
                        <label for="pisac">Pisac</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="isbn" name="isbn"  type="text" class="validate" required>
                        <label for="isbn">ISBN</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="brojStranica" name="brojStranica"  type="number" class="validate" required>
                        <label for="brojStranica">Broj Stranica</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="cijena" name="cijena"  type="number" class="validate" required>
                        <label for="cijena">Cijena</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="sadrzaj" name="sadrzaj" type="text" class="validate" required></textarea>
                        <label for="sadrzaj">Sadržaj</label>
                    </div>
                </div>
                <div class="file-field input-field">
                    <div class="btn blue darken-1">
                        <span>File</span>
                        <input type="file" name="slika">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light blue darken-1" type="submit" name="form1">Kreiraj knjigu
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>

            <!-- Form for updating new book -->
            <form class="col s6" id="update_book_form" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="idKnjige" name="idKnjige" type="number" class="validate" required>
                        <label for="idKnjige">Unesite ID knjige</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="nazivStupca">
                            <option value="naslov">Naslov</option>
                            <option value="pisac">Pisac</option>
                            <option value="isbn">ISBN</option>
                            <option value="brojStranica">Broj Stranica</option>
                            <option value="cijena">Cijena</option>
                            <option value="sadrzaj">Sadržaj</option>
                        </select>
                        <!-- <input id="nazivStupca" name="nazivStupca"  type="text" class="validate" required> -->
                        <label name="nazivStupca">Što želite promjenuti ?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="novaVrijednost" name="novaVrijednost" type="text" class="validate" required>
                        <label for="novaVrijednost">Nova vrijednost</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light blue darken-1" type="submit" name="form2">Izmjeni
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>

        </div>
    </main>
    
    <!-- Footer -->
    <?php include './partials/footer.php'; ?>

    <script>
        $(document).ready(function(){
            $('select').formSelect();
        });
    </script>

    <?php 
        if(isset($_SESSION['success_msg'])){
            if($_SESSION['success_msg'] === 'kreirano'){
                echo '<script language="javascript">';
                echo 'M.toast({html: "Uspješno kreirana knjiga !"})';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'M.toast({html: "Uspjesno izmjenjeno !"})';
                echo '</script>';
            }
            
            unset($_SESSION['success_msg']);
        }
    ?>
    
</body>
</html>