<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="ms-hero-page-override ms-hero-img-team ms-hero-bg-royal">
        <div class="container">
            <div class="text-center">
                <h2 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Associations</h2>
                <p class="lead lead-lg color-light text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Retrouvez ici toutes les associations présentes sur Paris Ynov Campus<br>Cliquez pour plus d'infos</p>
            </div>
        </div>
    </div>

    <div class="container container-full">
        <div class="card card-hero card-flat bg-transparent">
            <div class="row">
                <?php
                if (!is_null($Associations) && !empty($Associations))
                {
                    foreach ($Associations as $Asso)
                    {
                ?>

                <div class="col-lg-4 col-md-6">
                    <div class="card mt-4 card-primary wow zoomInUp animation-delay-7">
                        <div class="withripple zoom-img">
                            <a href="/asso/<?= htmlentities($Asso['id_asso']) ?>">
                                <img src="<?= htmlentities($Asso['logo']) ?>" alt="Logo" class="img-fluid center-block">
                            </a>
                            <div class="ripple-container"></div>
                        </div>
                        <div class="card-block">
                        <a href="/asso/<?= htmlentities($Asso['id_asso']) ?>" class="text-center">
                                <h3><?= htmlentities($Asso['name_asso']) ?></h3>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                    }
                }

                else echo '<div>Aucune association</div>';
                ?>
            </div>
        </div>
    </div>











                <article class="asso">
                    <div id="<?= htmlentities($Asso['name_asso']) ?>" class="modal">
                        <div>
                            <a href="#close" title="Fermer" class="close_modal">X</a>
                            <div class="modal_header">
                                <div>
                                    <img src="http://www.acteus.com/wp-content/uploads/2016/08/equipe-regulation.jpg" alt="Photo d'équipe" class="team">
                                    <div class="modal_name"><h3><?= htmlentities($Asso['name_asso']) ?></h3></div>
                                </div>
                            </div>
                            <div class="modal_image"><div><img src="<?= htmlentities($Asso['logo']) ?>"></div></div>
                            <div class="modal_social">
<?php

                                if (!is_null($Asso['email']) && !empty(htmlentities($Asso['email'])))
                                    echo '<a class="social" href="mailto:' . $Asso['email'] . '" title="Envoyer un mail à ' . $Asso['name_asso'] . '" target="_blank">Mail</a>&nbsp;';

                                if (!is_null($Asso['facebook_link']) && !empty(htmlentities($Asso['facebook_link'])))
                                    echo '<a class="social" href="' . $Asso['facebook_link'] . '" title="' . $Asso['name_asso'] . ' sur Facebook" target="_blank">Facebook</a>';

                                if (!is_null($Asso['twitter_link']) && !empty(htmlentities($Asso['twitter_link'])))
                                    echo '&nbsp;<a class="social" href="' . $Asso['twitter_link'] . '" title="' . $Asso['name_asso'] . ' sur Twitter" target="_blank">Twitter</a>';

                                ?>
                            </div>
                            <div class="modal_body"><p><?= htmlentities($Asso['description_asso']) ?></p></div>
                        </div>
                    </div>
                </article>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
