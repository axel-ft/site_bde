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
                    <h1 class="color-primary text-center">Désactiver le compte de <?php if (!is_null($User) && !empty($User)) echo htmlentities($User['username']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/users/deactivate/<?php if (!is_null($UserID) && !empty($UserID)) echo htmlentities($UserID) ?>">
                            <div class="row">
                                <div class="col-lg-12 h2 text-center">
                                    Voulez-vous vraiment désactiver ce compte ?
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6 text-center">
                                    <button type="submit" class="btn btn-raised btn-danger">Désactiver le compte de <?php if (!is_null($User) && !empty($User)) echo htmlentities($User['username']) ?></button>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="/manage/users" class="btn btn-default" role="button">Revenir à la liste des comptes</a>
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
