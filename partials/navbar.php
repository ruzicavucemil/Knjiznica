<?php

    include_once 'app/session.php';

    if(checkSession()){ ?>
        <ul id="dropdown1" class="dropdown-content">
            <li><a class="blue-text text-darken-1" href="<?php echo 'logout.php'; ?>">Odjava</a></li>
        </ul>
    <?php }else{ ?>
        <ul id="dropdown1" class="dropdown-content">
            <li><a class="blue-text text-darken-1" href="<?php echo 'login.php'; ?>">Prijava</a></li>
            <li><a class="blue-text text-darken-1" href="<?php echo 'register.php'; ?>">Registracija</a></li>
        </ul>
<?php } ?>
<nav class="blue darken-1">
    <div class="nav-wrapper">
        <a href="<?php echo 'index.php'; ?>" class="brand-logo left">Moja knjizara</a>
        <ul class="right">
        <?php if(checkSession()){ ?>
            <li><a href="<?php echo 'cart.php'; ?>"><i class="material-icons">shopping_cart</i></a></li>
        <?php } ?>
        <li><a href="<?php echo 'search.php'; ?>"><i class="material-icons">search</i></a></li>
        <!-- Dropdown Trigger -->
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>
