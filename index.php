<?php include 'app/session.php'; ?>
<!DOCTYPE html>
<html lang="hr">
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
        <?php echo 'Home'; /*Custom title*/ ?>
    </title>
</head>
<body>

    <!-- Navbar -->
    <?php include './partials/navbar.php'; ?>

    <!-- Content -->
    <div class="containter">
        <div class="row">
            <?php 
                include './app/database.php';
                include './partials/books.php';
                
                initializeConnection();

                $books = listBooks();
                displayBooks($books);

                closeConnection();
            ?>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include './partials/footer.php'; ?>

    
</body>
</html>