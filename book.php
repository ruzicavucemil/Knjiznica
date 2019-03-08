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

    <!-- Cookie.js -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <title>Online Knjizara | 
        <?php echo 'Knjiga'; /*Custom title*/ ?>
    </title>

</head>
<body>

    <!-- Navbar -->
    <?php include './partials/navbar.php'; ?>

    <!-- Content -->
    <?php 

        include './app/database.php';

        initializeConnection();

        $book = getBookById($_GET['id']);
    ?>
    <div class="container">
        <div class="row">
            <div class="col s8">
                <div class="card large">
                    <div class="card-image">
                        <img src="<?php echo 'assets/'.$book['slika']; ?>">
                        <span class="card-title"><?php echo $book['naslov']; ?></span>
                    </div>
                    <div class="card-content">
                        <p><?php echo $book['sadrzaj']; ?></p>
                    </div>
                    <?php if(checkSession()){ ?>
                        <div class="card-action">
                            <a id="addToCart" class="btn-floating blue"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col s4">
                <div class="card-panel teal">
                    <p class="white-text">
                        <b>Pisac: </b> 
                        <i><?php echo $book['pisac']; ?></i> 
                    </p>
                    <p class="white-text">
                        <b>Broj Stranica: </b> 
                        <i><?php echo $book['brojStranica']; ?></i> 
                    </p>
                    <p class="white-text">
                        <b>Cijena: </b> 
                        <i id="price"><?php echo $book['cijena']." KM"; ?></i> 
                    </p>
                    <p class="white-text">
                        <b>ISBN: </b> 
                        <i><?php echo $book['isbn']; ?></i> 
                    </p>
                </div>
            </div>
        </div>
    </div>


    <script>

        /* Pritiskom na tipku dodavanja u košaricu pojedine
           knjige, prikupit ce se podaci o knjizi i to:
                - Naslov knjige
                - Cijena
                - Putanja slike
           Nakon toga ce se svi podatci spremiti kao objekat
           u kolačić u obliku JSON formata.
        */
        document.querySelector('#addToCart').addEventListener("click",
         function(){
            let cartBooks = Cookies.get('books');

            let bookTitle = document.querySelector('.card-title').innerHTML;
            let bookPrice = document.querySelector('#price').innerHTML;
            let bookImage = document.querySelector('img').src;
            bookImage = bookImage.substr(bookImage.indexOf('assets'))

            let bookInfo = {
                "title": bookTitle,
                "price": bookPrice,
                "image": bookImage
            }

            if(cartBooks === undefined){
                let cartBooks = []
                cartBooks.push(bookInfo)
                console.info("Creating...")
                Cookies.set('books', cartBooks);
            }else{
                cartBooks = JSON.parse(cartBooks);
                cartBooks.push(bookInfo);
                console.info("Adding...")
                Cookies.set('books', cartBooks);
            }

         });
    </script>
    
    <!-- Footer -->
    <?php include './partials/footer.php'; ?>

    
</body>
</html>