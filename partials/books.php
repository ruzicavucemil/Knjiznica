<?php

    // Za 'index.php', prikazi po 3 knjige u jednom redu.
    function displayBooks($books){
        for ($index=0; $index < count($books); $index++) { 
            if($index % 3 == 0){
                echo '<div class="row">';
            }
            
            $book = $books[$index];
            displayBook($book);

            if($index % 3 == 2){
                echo '</div>';
            }
        }
    }

    // Prikaz pojedine knjige u redu.
    function displayBook($book){?>

        <div class="col s4">
            <div class="card large">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="<?php echo 'assets/'.$book["slika"]; ?>">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4"><?php echo $book["naslov"]; ?><i class="material-icons right">more_vert</i></span>
                    <p><a href="<?php echo 'book.php?id='.$book["idknjiga"]; ?>">Otvori</a></p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Sadržaj:<i class="material-icons right">close</i></span>
                    <p><?php echo $book["sadrzaj"]; ?></p>
                </div>
            </div>
        </div>
<?php 
    }

?>

