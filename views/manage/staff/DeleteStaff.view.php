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
                    <h1 class="color-primary text-center">Retirer <?php if (!is_null($Staff) && !empty($Staff)) echo htmlentities($Staff[0]['first_name'] . ' ' . $Staff[0]['last_name'] . ' de ' . $Staff[0]['name_asso']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/staff/<?= htmlentities($Staff[0]['id_asso']) ?>/delete/<?= htmlentities($Staff[0]['id_profile']) ?>">
                            <div class="row">
                                <div class="col-lg-12 h2 text-center">
                                    Voulez-vous vraiment retirer ce membre de l'association ?
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6 text-center">
                                    <button type="submit" class="btn btn-raised btn-danger">Retirer <?= htmlentities($Staff[0]['first_name'] . ' ' . $Staff[0]['last_name']) ?></button>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="/manage/staff" class="btn btn-default" role="button">Revenir à la liste des membres</a>
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
