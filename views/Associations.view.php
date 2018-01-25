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

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
