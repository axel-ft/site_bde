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
                <p class="lead lead-lg color-white text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Inscrivez-vous !</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                    <div class="card-block">
                        <h1 class="color-primary text-center">Inscription</h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/signup" enctype="multipart/form-data">
                            <fieldset>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account"></i>
                                                </span>
                                                <label class="control-label" for="username">Nom d'utilisateur <small>*</small></label>
                                                <input type="text" id="username" name="username" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-email"></i>
                                                </span>
                                                <label class="control-label" for="email">E-mail <small>*</small></label>
                                                <input type="email" id="email" name="email" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>
                                                <label class="control-label" for="password">Mot de passe <small>*</small></label>
                                                <input type="password" id="password" name="password" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>
                                                <label class="control-label" for="password_confirm">Mot de passe (confirmation) <small>*</small></label>
                                                <input type="password" id="password_confirm" name="password_confirm" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account"></i>
                                                </span>
                                                <label class="control-label" for="first_name">Prénom <small>*</small></label>
                                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account"></i>
                                                </span>
                                                <label class="control-label" for="last_name">Nom <small>*</small></label>
                                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-upload"></i>
                                                </span>
                                                <input type="text" readonly="true" class="form-control" placeholder="Photo de profil - Parcourir...">
                                                <input type="file" id="avatar" name="avatar" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-facebook"></i>
                                                </span>
                                                <label class="control-label" for="facebook_link">Lien Facebook</label>
                                                <input type="url" id="facebook_link" name="facebook_link" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <fieldset>
                            <button type="submit" class="btn btn-raised btn-primary btn-block">Créer un compte <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                        <p class="text-center">Déjà un compte ? <a href="/login" title="Connexion">Connectez-vous</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>

