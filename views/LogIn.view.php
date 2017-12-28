<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="ms-hero-page-override ms-hero-img-city ms-hero-bg-dark-light">
        <div class="container">
            <div class="text-center">
                <span class="ms-logo ms-logo-lg ms-logo-white center-block mb-2 mt-2 animated zoomInDown animation-delay-5">Y</span>
                <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Inter-<span>Assos</span></h1>
                <p class="lead lead-lg color-white text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Connectez-vous pour accéder aux photos ou autres informations pour lesquelles un compte est nécessaire</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6">
                <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                    <div class="card-block">
                        <h1 class="color-primary text-center">Connexion</h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/login">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        <label class="control-label" for="username">Nom d'utilisateur <small>*</small></label>
                                        <input type="text" id="username" name="username" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-lock"></i>
                                        </span>
                                        <label class="control-label" for="username">Mot de passe <small>*</small></label>
                                        <input type="password" id="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-raised btn-primary btn-block">Se connecter <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                        <p class="text-center">Pas encore de compte ? <a href="/signup" title="Inscription">Inscrivez-vous</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
