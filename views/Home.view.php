<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>





    <?php if ($Message !== null) echo $Message ?>
    <section id="welcome">
        <h1>Bienvenue sur le site du BDE YNOV PARIS</h1>
    </section>





    <div class="container container-full">
        <h3 class="text-center color-primary mb-4">Événements</h3>
        <?php
        if (!is_null($Events) && !empty($Events))
        {
            echo '<div class="owl-events owl-carousel owl-theme">';
            
            foreach ($Events as $Event)
            {
        ?>

                <div class="card card-primary animation-delay-5">
                    <div class="withripple zoom-img">
                        <a href="/event/<?= htmlentities($Event['id_event']) ?>">
                            <img class="img-fluid" src="https://semantic-ui.com/images/wireframe/square-image.png" alt="Affiche">
                        </a>
                    </div>
                    <div class="card-block">
                        <h3 class="color-primary"><?= htmlentities($Event['name_event']) ?></h3>
                        <p><?= strftime('le %e %B %G', htmlentities($Event['begin_date']->getTimestamp())) ?></p>
                        <p class="text-right">
                            <a class="btn btn-raised btn-primary" href="/event/<?= htmlentities($Event['id_event']) ?>" role="button">En savoir plus...<div class="ripple-container"></div></a>
                        </p>
                    </div>
                </div>

        <?php
            }

            echo '</div><div class="owl-events-dots owl-dots"></div>';
        }

        else echo '<div>Aucun événement</div>';
        ?>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
    <script type="text/javascript" src="/public/js/owl-home.js"></script>
</body>

</html>
