<?php 
include 'app/session.php'; 
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

    <!-- Cookie.js -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <title>Online Knjizara | 
        <?php echo 'Korpa'; /*Custom title*/ ?>
    </title>
</head>
<body>

    <!-- Navbar -->
    <?php include './partials/navbar.php'; ?>

    <!-- Content -->
    <div class="row">
        <div class="col s3"></div>
        <div class="col s6">
        <ul class="collection">
            <!-- Popunjavanje knjigama u košarici. -->
        </ul>
        </div>
        <div class="col s3"></div>
    </div>

    <hr>

    <div class="row">
        <div class="col s3"></div>
        <div class="col s6 center-align">
            <a class="waves-effect waves-light btn blue darken-1 kupovina"><i class="material-icons left">attach_money</i>Kupovina</a>
        </div>
        <div class="col s3"></div>
    </div>

    <!-- Footer -->
    <?php include './partials/footer.php'; ?>

    <script>

        // Prikaz svih dodanih knjiga u košarici.
        let books = JSON.parse(Cookies.get('books'));
        let ukupnaCijena = 0.0;
        for(var i = 0; i < books.length; i++) {
            var book = books[i];

            var title = book.title;
            var price = book.price;
            var image = book.image;

            ukupnaCijena += parseFloat(price);

            // <li class="collection-item avatar">
            //     <img src="assets/zlocin_i_kazna.jpg" alt="" class="circle">
            //     <span class="title">Zlocin i kazna</span>
            //     <a href="#!" class="secondary-content"><span>45.50 KM</span></a>
            // </li>

            var li = $('<li></li>').addClass('collection-item avatar');
            var img = $('<img>')
                        .addClass('circle')
                        .attr('src', `${image}`);
            var span = $('<span></span>')
                        .addClass('title')
                        .text(title);
            var a = $('<a></a>')
                        .addClass('secondary-content')
                        .attr('href', `#!`);
            var span_price = $('<span></span>')
                        .text(`${price}`);
            a.append(span_price);

            $("ul.collection").append(li.append(img, span, a));
        }

        // Prikaz ukupne cijene za knjige u košarici
        var li = $('<li></li>').addClass('collection-item center-align');
        var subtext = $('<small></small>').text("UKUPNO:")
        var pr = $('<h5></h5>').text(ukupnaCijena.toString() + " KM");
        li.append(subtext, pr);

        $("ul.collection").append(li);

        // Klikom na kupovina, šalje se request na buy_books.php . Request prima
        // sve knjige kao JSON format i sprema ih u tablicu 'racun'.
        document.querySelector(".kupovina").addEventListener('click', function(){
            
            booksJSON = Cookies.get('books');
            
            if(booksJSON.length == 0){
                return;
            }
            
            Cookies.remove('books');

            $.ajax({
                    type: "POST",
                    url: 'https://moja-knjizaraa.000webhostapp.com/partials/buy_books.php',
                    dataType: 'json',
                    data: booksJSON
            })

            location.reload();
        });
    </script>
    
</body>
</html>
