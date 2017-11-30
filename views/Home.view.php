<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <link rel="stylesheet" type="text/css" href="/public/css/home.css">
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
    <section id="welcome">
        <h1>Bienvenue sur le site du BDE YNOV PARIS</h1>
    </section>

    <section class="events">
        <h2>Evénements</h2>
        <div id="events_slider">
        <?php
        if (!is_null($Events) && !empty($Events))
        {
            foreach ($Events as $Event)
            {
        ?>
                <article class="events">
                    <img src="https://semantic-ui.com/images/wireframe/square-image.png">
                    <h3><?= htmlentities($Event['name_event']) ?></h3>
                    <p><?= strftime('le %e %B %G', htmlentities($Event['begin_date']->getTimestamp())) ?></p>

                    <a class="button" href="#">En savoir plus...</a>
                </article>
        <?php
            }
        }

        else
        {
    ?>
        <div>Aucun événement</div>
    <?php } ?>
        </div>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
