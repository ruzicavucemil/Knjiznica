<?php include 'app/session.php'; ?>
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
        <?php echo 'Pretraga knjiga'; /*Custom title*/ ?>
    </title>
</head>
<body>

    <!-- Navbar -->
    <?php include './partials/navbar.php'; ?>

    <!-- Content -->
    <div class="row">
        <div class="col s3"></div>
        <div class="input-field col s6">
            <input id="search" type="text" class="validate">
            <label for="search">Unesite naziv knjige</label>
        </div>
        <div class="col s3"></div>
    </div>
    <div class="row">
        <div class="col s3"></div>
        <div class="col s6">
        <ul class="collection">
            <!-- Popunjavanje knjigama. -->
        </ul>
        </div>
        <div class="col s3"></div>
    </div>
    <!-- Footer -->
    <?php include './partials/footer.php'; ?>

    <script>

        // Pri svakom novom unesenom slovu u polje 'pretraga',
        // izvršit će se AJAX zahtjev.
        document.querySelector('#search')
                .addEventListener('keyup', function(e){

                    // Ako je polje prazno, ne izvršava se zahtjev
                    // (nema naziva knjige).
                    if(e.target.value === ''){
                        $('ul.collection').empty();
                        return false;
                    }

                    // Ako polje nije prazno tj. ako je unesen
                    // tekst, pošalji uneseni tekst na PHP stranu,
                    // provjeri sve knjige koje u nazivu sadrže
                    // uneseni tekst i vrati ih.
                    $.ajax({
                        method: "GET",
                        url: "partials/search_books.php",
                        data: { naslov: e.target.value }
                        })
                        .done(function( response ) {
                            let books = JSON.parse(response);

                            if(books == null){
                                return false;
                            }

                            // Isprazni polje (radi novog unosa).
                            $('ul.collection').empty();

                            // Popuni pretragu knjigama koje su vraćene.
                            for(var i = 0; i < books.length; i++) {
                                var book = books[i];

                                var id = book.idknjiga;
                                var naslov = book.naslov;
                                var slika = book.slika;

                                // <li class="collection-item avatar">
                                //     <img src="assets/zlocin_i_kazna.jpg" alt="" class="circle">
                                //     <span class="title">Zlocin i kazna</span>
                                //     <a href="#!" class="secondary-content"><i class="material-icons">arrow_forward</i></a>
                                // </li>

                                var li = $('<li></li>').addClass('collection-item avatar');
                                var img = $('<img>')
                                           .addClass('circle')
                                           .attr('src', `assets/${slika}`);
                                var span = $('<span></span>')
                                            .addClass('title')
                                            .text(naslov);
                                var a = $('<a></a>')
                                         .addClass('secondary-content')
                                         .attr('href', `book.php?id=${id}`);
                                var icon = $('<i></i>')
                                            .addClass('material-icons')
                                            .text('arrow_forward');
                                a.append(icon);

                                $("ul.collection").append(li.append(img, span, a));

                            }
                        });
                });
    </script>


    
</body>
</html>