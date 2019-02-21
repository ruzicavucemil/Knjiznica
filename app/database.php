<?php

    $conn = null;

    function initializeConnection(){
        global $conn;

        // PODATCI O BAZI PODATAKA !!!
        $servername = "localhost";
        $username = "id8539685_ruzica";
        $password = "ruzica123";
        $dbname = "id8539685_knjizara";

        // Uspostavljanje konekcije na bazu podataka.
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset('utf8mb4');

        // Ako spajanje nije uspjelo, prekini sva daljnja
        // učitavanja stranice.
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    // Provjera login podataka.
    function loginCheck($email, $pass){
        global $conn;

        // Ako se email i lozinka uneseni u formi
        // nalaze u bazi, korisnik je unio
        // ispravne podatke. Korisnik se stoga
        // uspješno prijavio.
        $sql =  "SELECT * FROM korisnik WHERE";
        $sql .= " email='".$email."'";
        $sql .= " AND lozinka='".$pass."'";

        $result = $conn->query($sql);

        // Samo bi jedan redak u tablici
        // 'korisnik' trebao postojati sa tim e-mailom.
        if ($result->num_rows == 1) {
            $_SESSION['email'] = $email;
            return true;
        }
        return false;
    }

    // Stvaranje novog korisnika pri uspješnoj registraciji.
    function registerCheck($email, $pass, $first_name, $last_name, $age){
        global $conn;

        $sql =  "SELECT * FROM korisnik WHERE";
        $sql .= " email='".$email."'";

        $result = $conn->query($sql);

        // Ako korisnik sa prosljeđenim email-om
        // iz registacijske forme već postoji u 
        // bazi podataka, ne može se stvoriti
        // novi korisnik.
        if ($result->num_rows == 1) {
            return false;
        }


        // Unos novog korisnika u bazu podataka.
        $sql  = "INSERT INTO korisnik (ime, prezime, starost, email, lozinka) VALUES ";
        $sql .= "('".$first_name."','".$last_name."',".$age.",'".$email."','".$pass."')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }

    // Izlistavanje svih knjiga na stranici 'index.php'.
    function listBooks(){
        global $conn;

        $sql  = "SELECT idknjiga, naslov, sadrzaj, slika FROM knjiga";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $books = array();

            // Ispis knjiga.
            while($row = $result->fetch_assoc()) {
                array_push($books, $row);
            }
            
            return $books;

        }else{
            echo '<h1>Na ovoj stranici nisu dostupne knjige</h1>';
        }
    }

    // Prikaz detaljnjih podataka o pojedinoj knjizi.
    function getBookById($id){
        global $conn;

        $sql  = "SELECT * FROM knjiga WHERE idknjiga='".$id."'";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            return $result->fetch_assoc();
        }else{
            return 'No book with that ID';
        }

    }

    // Pri pretrazi knjiga, vrati samo one knjige koje u sebi
    // nose dio naziva unesenih rijeci.
    function searchBooks($naslov){
        global $conn;

        $sql  = "SELECT idknjiga, naslov, slika FROM knjiga ";
        $sql .= "WHERE naslov LIKE '%".$naslov."%'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $books = array();

            // Ispis knjiga.
            while($row = $result->fetch_assoc()) {
                array_push($books, $row);
            }
            
            return $books;

        }else{
            echo '';
        }
    }

    // Otpusti konekciju sa baze podataka.
    function closeConnection(){
        global $conn;
        $conn->close();
        $conn = null;
    }

    

    



?>
