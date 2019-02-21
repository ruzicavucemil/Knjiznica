<!-- Footer with JQuery and materialize javascript -->
<footer class="page-footer blue darken-1">
    <div class="footer-copyright">
    <div class="container">
    Made by <?php


        // TODO: Promjenut imena pravih korisnika
        $developers = array("Ružica Vučemil", "Valerija Ereš", "Božena Mihaljević");

        for ($x=0; $x < count($developers); $x++) {
            echo '<b>';
            echo $developers[$x] . ' | ';
            echo '</b>';
        }

    ?>

    <!-- Get current date represented as Year-Month-Day -->
    <a class="grey-text text-lighten-4 right weather" href="#!">
    <?php echo date("Y-m-d"); ?>
    </a>
    </div>
    </div>
</footer>

<!-- JQuery -->
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!-- Script for dropdown -->
<script>
    $(".dropdown-trigger").dropdown();
</script>
