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
                    <h1 class="color-primary text-center">Supprimer <?= htmlentities($Category[0]['name_cat']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/categories/delete/<?= htmlentities($Category[0]['id_category']) ?>">
                            <div class="row">
                                <div class="col-lg-12 h2 text-center">
                                    Voulez-vous vraiment supprimer cette catégorie ?
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6 text-center">
                                    <button type="submit" class="btn btn-raised btn-danger">Supprimer la catégorie <?= htmlentities($Category[0]['name_cat']) ?></button>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="/manage/categories" class="btn btn-default" role="button">Revenir à la liste des catégories</a>
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
