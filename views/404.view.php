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
                <div class="card animated fadeInUp animation-delay-7 color-primary withripple">
                    <div class="card-block-big color-dark">
                        <div class="text-center">
                            <h1 class="color-primary">404</h1>
                            <h2>Page non trouvée</h2>
                            <p class="lead lead-sm">Vous avez du vous égarer...</p>
                            <a href="/" class="btn btn-primary btn-raised">
                                <i class="zmdi zmdi-home"></i>Retour à l'accueil
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card animated fadeInUp animation-delay-9 color-primary withripple">
                    <div class="card-block-big color-dark">
                        <h2 class="color-primary">Rechercher</h2>
                        <p class="lead">Vous pouvez utiliser la recherche pour trouver ce que vous cherchez.</p>
                        <div class="form-group label-floating">
                            <label class="control-label" for="search">Rechercher...</label>
                            <input type="text" name="search" id="search" class="form-control">
                        </div>
                        <a href="/search/" class="btn btn-primary btn-raised btn-block">
                            <i class="zmdi zmdi-search"></i>Rechercher
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
