<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="ms-hero ms-hero-material">
        <span class="ms-hero-bg"></span>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($Message !== null) echo $Message ?>

                    <div class="ms-hero-material-text-container">
                        <header class="ms-hero-material-title animated slideInLeft animation-delay-5">
                            <h1 class="animated fadeInLeft animation-delay-15 text-center">Bienvenue sur le <strong>site Inter-Associations</strong> de Paris Ynov Campus</h1>
                            <h2 class="animated fadeInLeft animation-delay-18 text-center">Les informations de <span class="color-info">toutes les associations</span> du campus</h2>
                        </header>
                        <div class="row ms-hero-material-list mb-2 d-none d-md-flex">
                            <div class="col-md-4">
                                <div class="ms-list-icon animated zoomInUp animation-delay-18 text-center mb-2">
                                    <span class="ms-icon ms-icon-circle ms-icon-xlg color-info shadow-3dp">
                                        <i class="zmdi zmdi-accounts"></i>
                                    </span>
                                </div>
                                <div class="ms-list-text text-center animated fadeInRight animation-delay-19">
                                    Retrouvez toutes les associations du campus
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ms-list-icon animated zoomInUp animation-delay-20 text-center mb-2">
                                    <span class="ms-icon ms-icon-circle ms-icon-xlg color-info shadow-3dp">
                                        <i class="zmdi zmdi-calendar-check"></i>
                                    </span>
                                </div>
                                <div class="ms-list-text text-center animated fadeInRight animation-delay-21">
                                    Accéder aux événements associatif futurs ou passés
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ms-list-icon animated zoomInUp animation-delay-22 text-center mb-2">
                                    <span class="ms-icon ms-icon-circle ms-icon-xlg color-info shadow-3dp">
                                        <i class="zmdi zmdi-image"></i>
                                    </span>
                                </div>
                                <div class="ms-list-text text-center animated fadeInRight animation-delay-23">
                                    Voir ou revoir les photos des événements
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="ms-hero-material-buttons align-self-end">
                                    <a href="/assos" class="btn btn-info btn-raised btn-block animated fadeInUp animation-delay-24">Les associations</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ms-hero-material-buttons align-self-end">
                                    <a href="/events" class="btn btn-info btn-raised btn-block animated fadeInUp animation-delay-25">Les événements</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ms-hero-material-buttons align-self-end">
                                    <a href="/photos" class="btn btn-info btn-raised btn-block animated fadeInUp animation-delay-26">Les photos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-6">
        <h1 class="text-center color-primary mb-4">Dernières publications</h2>
        <?php
        if (!is_null($Posts) && !empty($Posts))
        {
            echo '<div class="row masonry-container">';

            foreach ($Posts as $Post)
            {
        ?>
                <div class="col-md-12 masonry-item wow fadeInUp animation-delay-2">
                    <article class="card card-primary mb-4 wow materialUp animation-delay-5">
                        <div class="card-block">
                            <div class="row">
                                <?php if(!is_null($Post['heading_image'])) { ?>
                                <div class="col-xl-6 mb-4">
                                    <div class="withripple zoom-img text-center">
                                        <a href="/post/<?= htmlentities($Post['id_post']) ?>">
                                            <img class="img-fluid" src="<?= htmlentities($Post['heading_image']) ?>" alt="Affiche">
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-xl-<?= (!is_null($Post['heading_image'])) ? '6' : '12' ?> mb-4">
                                    <h2 class="color-primary no-mt"><?= htmlentities($Post['name_post']) ?></h3>
                                    <p><?= htmlentities($Post['content_post']) ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                <p><?= (!is_null($Post['avatar'])) ? '<img src="' . htmlentities($Post['avatar']) . '" alt="Photo de profil" class="img-small img-fluid rounded-circle mr-1">' : '' ?> publié par <a href="/profile/<?= htmlentities($Post['id_profile']) ?>"><?= htmlentities($Post['first_name'] . ' ' . $Post['last_name']) ?></a><?= (!is_null($Post['id_category'])) ? ', dans <a href="/category/' . htmlentities($Post['id_category']) . '" class="ms-tag ms-tag-primary">' . htmlentities($Post['name_cat']) . '</a>' : '' ?> <span class="ml-1 d-none d-sm-inline"><i class="zmdi zmdi-time mr-05 color-primary"></i><span class="color-medium-dark"><?= strftime('le %e %B %G', htmlentities($Post['publish_date']->getTimestamp())) ?></span></span> <?= (!is_null($Post['edited_date'])) ? '<span class="ml-1 d-none d-sm-inline"><i class="zmdi zmdi-edit mr-05 color-primary"></i><span class="color-medium-dark">' . strftime('le %e %B %G', htmlentities($Post['edited_date']->getTimestamp())) . '</span></span>' : '' ?></p>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <a class="btn btn-raised btn-primary" href="/post/<?= htmlentities($Post['id_post']) ?>" role="button">Lire la suite...</a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
        <?php
            }

            echo '</div>';
        }

        else echo '<div>Aucune publication</div>';
        ?>
    </div>

    <div class="container-fluid mt-6">
        <h1 class="text-center color-primary mb-4">Prochains événements</h2>
        <?php
        if (!is_null($Events) && !empty($Events))
        {
            echo '<div class="owl-events owl-carousel owl-theme">';

            foreach ($Events as $Event)
            {
        ?>
                <div class="card card-primary animation-delay-5">
                    <div class="withripple zoom-img text-center">
                        <a href="/event/<?= htmlentities($Event['id_event']) ?>">
                        <img class="img-fluid" src="<?= htmlentities($Event['poster']) ?>" alt="Affiche">
                        </a>
                    </div>
                    <div class="card-block">
                        <h2 class="color-primary"><?= htmlentities($Event['name_event']) ?></h3>
                        <p><?= strftime('le %e %B %G', htmlentities($Event['begin_date']->getTimestamp())) ?></p>
                        <p class="text-right">
                            <a class="btn btn-raised btn-primary" href="/event/<?= htmlentities($Event['id_event']) ?>" role="button">En savoir plus...</a>
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
