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
                    <h1 class="color-primary text-center">Supprimer <?php if (!is_null($Event) && !empty($Event)) echo htmlentities($Event['name_event']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/events/delete/<?php if (!is_null($IdEvent) && !empty($IdEvent)) echo htmlentities($IdEvent) ?>">
                            <div class="row">
                                <div class="col-lg-12 h2 text-center">
                                    Voulez-vous vraiment supprimer cet événement ?
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6 text-center">
                                    <button type="submit" class="btn btn-raised btn-danger">Supprimer l'événement <?php if (!is_null($Event) && !empty($Event)) echo htmlentities($Event['name_event']) ?></button>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="/manage/events" class="btn btn-default" role="button">Revenir à la liste des événements</a>
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
