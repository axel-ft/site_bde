<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                    <div class="card-block">
                    <h1 class="color-primary text-center">Masquer le profil de <?php if (!is_null($Profile) && !empty($Profile)) echo htmlentities($Profile['first_name'])." ".htmlentities($Profile['last_name']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/profiles/delete/<?php if (!is_null($ProfileID) && !empty($ProfileID)) echo htmlentities($ProfileID) ?>">
                            <div class="row">
                                <div class="col-lg-12 h2 text-center">
                                    Ce profil est lié à un compte utilisateur, il ne peut donc pas être supprimé mais seulement masqué. Si le compte lié est actif, il sera désactivé.<br>
                                    Voulez-vous vraiment masquer ce profil ?
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6 text-center">
                                    <button type="submit" class="btn btn-raised btn-danger">Masquer le profil de <?php if (!is_null($Profile) && !empty($Profile)) echo htmlentities($Profile['first_name'])." ".htmlentities($Profile['last_name']) ?></button>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="/manage/profiles" class="btn btn-default" role="button">Revenir à la liste des profils</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
