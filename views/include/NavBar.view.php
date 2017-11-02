<header id="home">
    <nav id="navbar_light">

        <a href="index.php" title="Accueil"><div id="logo_menu"></div></a>

        <ul>
            <li><a class="" href="/home">Accueil</a></li>
            <li><a class="" href="/assos">Vos Assos</a></li>
            <li><a class="" href="/events">Vos Events</a></li>
            <li><a class="" href="/bde">Votre BDE</a></li>
            <li><a class="" href="/contact">Nous Contacter</a></li>

            <?php if (!isset($_SESSION['connected'])) { ?>
                <li><a href="/login">Connexion</a></li>
                <li><a href="/signup">Créer un compte</a></li>
            <?php } else if ($_SESSION['connected']) { ?>
                <li>
                    <a href="/myprofile">Mon compte</a>
                    <?php if (isset($_SESSION['manager'])) { ?>
                    <ul>
                        <li><a href="/manage/assos">Associations</a></li>
                        <li><a href="/manage/events">Evénements</a></li>
                        <li><a href="/manage/profiles">Profils</a></li>
                        <li><a href="/manage/users">Utilisateurs</a></li>
                    </ul>
                    <?php } ?>
                </li>
                <li><a href="/logout">Déconnexion</a></li>
            <?php } ?>

        </ul>

        <form id="recherche_form" method="get" action="">
            <input type="hidden" name="p" value="recherche">
            <input type="search" name="query" placeholder="Rechercher" value="<?php if(!empty($_GET['query'])) echo $_GET['query']; ?>">
            <button type="submit"><i class="material-icons">search</i></button>
        </form>

    </nav>
</header>
