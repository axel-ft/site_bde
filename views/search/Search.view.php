<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <?php if ($Message !== null) echo $Message ?>
                <div class="card card-primary animated fadeInUp animation-delay-7 color-primary">
                    <div class="card-block-big color-dark">
                        <h2 class="color-primary">Rechercher</h2>
                        <p class="lead">Vous pouvez utiliser la recherche pour (re)trouver ce que vous avez égaré</p>
                        <form action="/search" method="POST" class="form-group label-floating">
                            <label class="control-label" for="search">Rechercher...</label>
                            <input type="search" name="query" id="search" class="form-control" required>
                            <button type="submit" class="btn btn-primary btn-raised btn-block">
                                <i class="zmdi zmdi-search"></i>Rechercher
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
