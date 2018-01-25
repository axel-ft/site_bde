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
                    <h1 class="color-primary text-center">Désactiver mon compte</h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/myprofile/deactivate">
                            <div class="row">
                                <div class="col-lg-12 h2 text-center">
                                    Voulez-vous vraiment désactiver votre compte ?
                                </div>
                            </div>
                            <div class="form-group label-floating">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="zmdi zmdi-lock"></i>
                                    </span>
                                    <label class="control-label" for="password_conf">Entrez votre mot de passe pour confirmer <small>*</small></label>
                                    <input type="password" name="password_conf" id="password_conf" class="form-control" required>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6 text-center">
                                    <button type="submit" class="btn btn-raised btn-danger">Désactiver mon compte</button>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="/myprofile" class="btn btn-default" role="button">Revenir à mon profil</a>
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
